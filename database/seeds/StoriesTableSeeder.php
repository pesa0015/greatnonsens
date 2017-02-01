<?php

use Illuminate\Database\Seeder;

class StoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('stories')->insert([
        //     'title' => 'test',
        //     'slug' => 'test',
        //     'rounds' => 5,
        //     'max_writers' => 10,
        //     'num_of_writers' => 1,
        //     'status' => 0,
        //     'user_id' => 1
        // ]);

        factory(App\Story::class, 10)->create();
    }
}
