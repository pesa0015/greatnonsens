<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StoryRepository;

class StoryController extends Controller
{
    protected $repository;
    protected $storyWriterRepository;
    protected $rowRepository;

    public function __construct(StoryRepository $repository){
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = $this->repository->where('status', 0)->paginate(10);

        return response()->json(['stories' => $stories], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        \App\Repositories\StoryWriterRepository $writerRepository,
        \App\Repositories\RowRepository $wordRepository
        )
    {
        $story = $this->repository->create([
            'title' => $request->title,
            'slug' => $request->slug,
            'rounds' => $request->rounds,
            'max_writers' => $request->max_writers,
            'num_of_writers' => 1,
            'status' => 0,
            'user_id' => $request->user_id
        ]);

        $this->rowRepository = $wordRepository;

        $row = $this->rowRepository->create([
            'words' => $request->words,
            'story_id' => $story->id,
            'user_id' => $request->user_id
        ]);

        $this->storyWriterRepository = $writerRepository;

        $writer = $this->storyWriterRepository->create([
            'story_id' => $story->id,
            'user_id' => $request->user_id,
            'on_turn' => 0,
            'round' => 2
        ]);

        return response()->json($story, 200);
    }

    /**
     * Join the story
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request, \App\Repositories\StoryWriterRepository $writerRepository)
    {
        $story = $this->repository->find($request->story_id);

        $on_turn = ($story->num_of_writers == 1) ? 1 : 0;

        $this->storyWriterRepository = $writerRepository;

        $writer = $this->storyWriterRepository->create([
            'story_id' => $request->story_id,
            'user_id' => $request->user_id,
            'on_turn' => $on_turn,
            'round' => 1
        ]);

        $story = $this->repository->update([
            'num_of_writers' => $story->num_of_writers + 1
        ], $story->id);

        if ($story->max_writers == $story->num_of_writers)
            $story = $this->repository->update(['status' => 2], $story->id);

        return response()->json(['story' => $story], 200);
    }

    public function begin($id)
    {
        $story = $this->repository->find($id);

        if ($story->num_of_writers < 3)
            return response()->json(['error' => '']);

        $story->timestamps = false;
        $story->status = 1;
        $story->update();

        $story = $this->repository->update([
            'status' => 1
        ], $story->id);

        return response()->json([], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story = $this->repository->find($id);

        if ($story->status == 1)
            return response()->json(['error' => ''], 404);

        $story = $this->repository->delete($id);

        return response()->json([], 200);
    }
}
