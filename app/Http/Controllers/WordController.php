<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\RowRepository;

class WordController extends Controller
{
    protected $repository;
    protected $storyWriterRepository;
    protected $storyRepository;

    public function __construct(RowRepository $repository){
        $this->repository = $repository;
    }

    /**
     * Write some words to the story
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        \App\Repositories\StoryWriterRepository $writerRepository,
        \App\Repositories\StoryRepository $storyRepo
        )
    {
        $story_id = $request->story_id;
        $user_id = $request->user_id;

        $this->storyWriterRepository = $writerRepository;
        
        $writer = $this->storyWriterRepository->findWhere([
            'story_id' => $story_id,
            'user_id' => $user_id,
            'on_turn' => true
        ])->first();

        if (!$writer)
            return response()->json(['error' => ''], 404);

        $this->storyRepository = $storyRepo;

        $words = $this->repository->create([
            'words' => $request->words,
            'story_id' => $story_id,
            'user_id' => $user_id
        ]);

        $writer = $this->storyWriterRepository->update([
            'on_turn' => 0,
            'round' => $writer->round + 1
        ], $writer->id);

        $nextWriter = $this->storyWriterRepository->findWhere([
            'story_id' => $story_id,
            'id' => $writer->id + 1,
            'on_turn' => false
        ])->first();

        if ($nextWriter) {
            $nextWriter = $this->storyWriterRepository->update([
                'on_turn' => 1
            ], $nextWriter->id);
            return response()->json(['next_writer' => $nextWriter], 200);
        }

        $story = $this->storyRepository->find($story_id);

        if ($story->rounds == $writer->round) {
            $story = $this->storyRepository->update(['status' => 2], $story_id);
            return response()->json(['finished' => true], 200);
        }

        $nextRoundWriter = $this->storyWriterRepository->findWhere(['story_id' => $story_id])->first();
        $nextRoundWriter = $this->storyWriterRepository->update(['on_turn' => 1], $nextRoundWriter->id);

        return response()->json(['next_round' => $nextRoundWriter], 200);
    }
}
