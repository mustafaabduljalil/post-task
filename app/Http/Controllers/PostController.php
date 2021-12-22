<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use App\Models\PostImage;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(['error' => false, 'data' => $this->postService->list(['images'])]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validatedData = $request->safe()->only(['title', 'body']);
            $validatedData['user_id'] = auth()->id();
            $post = $this->postService->store($validatedData);
            // store post images if uploaded
            if($request->has('images')){
                $this->postService->storePostImages($request->images, $post);
            }
        });
        return response()->json(200);
    }
}
