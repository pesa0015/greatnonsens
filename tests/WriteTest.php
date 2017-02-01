<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WriteTest extends TestCase
{
    public function newUser($num = 1)
    {
        return factory(App\User::class, $num)->create();
    }

    public function newStory()
    {
        $users = $this->newUser(5);

        $story = factory(App\Story::class)->create();

        return (object) ['story' => $story, 'users' => $users];
    }
    /**
     * @group beginStory
     *
     */
    public function testWriting()
    {
        $faker = Faker\Factory::create();

        $users = $this->newUser(5);

        $title = $faker->words(3, true);

        $story = $this->call('POST', 'api/stories', [
            'title' => $title,
            'slug' => str_slug($title, '-'),
            'rounds' => 5,
            'max_writers' => 5,
            'user_id' => $users[0]->id,
            'words' => $faker->text(40)
        ]);

        $id = $story->getData()->id;
        $rounds = $story->getData()->rounds;

        for ($i = 1; $i < count($users); $i++) {
        	$writers = $this->call('POST', '/api/stories/join', [
        		'story_id' => $id,
        		'user_id' => $users[$i]->id
        	]);
        }

        for ($i = 0; $i < ($rounds * count($users) -1); $i++) {
        	$currentWriter = \App\StoryWriter::where('story_id', $id)->where('on_turn', true)->first();
            $write = $this->call('POST', '/api/words', [
                'words' => str_random(25),
                'story_id' => $id,
                'user_id' => $currentWriter->user_id
            ]);

            if (isset($write->getData()->finished))
                break;

        }

        $this->seeJson([
            'finished' => true
        ]);
    }

    /**
     * @group deleteStory
     *
     */
    public function testDeleteStory()
    {
        $story = $this->newStory();

        $this->call('DELETE', 'api/stories/' . $story->story->id);

        $this->assertResponseOk();
    }

    /**
     * @group leaveStory
     *
     */
    public function testLeaveStory()
    {
        $story = $this->newStory();

        $id = $story->story->id;

        $users = $story->users;

        for ($i = 1; $i < count($users); $i++) {
            $writers = $this->call('POST', '/api/stories/join', [
                'story_id' => $id,
                'user_id' => $users[$i]->id
            ]);
        }

        $leave = $this->call('DELETE', '/api/writers/' . $id, [
            'user_id' => $users[1]->id
        ]);

        $this->seeJsonStructure([
            'id',
            'story_id',
            'user_id',
            'on_turn',
            'round',
            'created_at',
            'updated_at'
        ])->assertResponseOk();
    }
}
