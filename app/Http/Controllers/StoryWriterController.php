<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories;

class StoryWriterController extends Controller
{
    protected $repository;
    protected $storyRepository;

    public function __construct(Repositories\StoryWriterRepository $repository, Repositories\StoryRepository $storyRepo)
    {
        $this->repository = $repository;
        $this->storyRepository = $storyRepo;
    }

    /**
     * Leave the story
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $story = $this->storyRepository->find($id);

        if ($story->status == 1)
            return response()->json([], 404);

        $writer = $this->repository->findWhere([
            'story_id' => $id,
            'user_id' => $request->user_id
        ])->first();

        $other_writer = false;

        if ($writer->on_turn == 1) {
            $other_writer = $this->repository->findWhere([
                'story_id' => $id,
                'on_turn' => false
            ]);

            $other_writer = $this->repository->update(['on_turn' => 1], $other_writer[1]->id);
        }

        $writer = $this->repository->delete($writer->id);

        return response()->json($other_writer, 200);
    }
}
