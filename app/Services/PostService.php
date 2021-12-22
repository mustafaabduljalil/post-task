<?php

namespace App\Services;

use App\Models\PostImage;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Storage;

class PostService
{
    protected $postRepository, $uploadImageService;

    public function __construct(PostRepository $postRepository, UploadImageService $uploadImageService)
    {
        $this->postRepository = $postRepository;
        $this->uploadImageService = $uploadImageService;
    }

    /**
     * Retrieve posts list.
     *
     * @return array
     */
    public function list($relations)
    {
        return $this->postRepository->list($relations);
    }

    /**
     * Retrieve only one post.
     *
     * @return object
     */
    public function getOnePost()
    {
        return $this->postRepository->getOnePost();
    }

    /**
     * Store new post.
     *
     * @return \App\Models\Post $post
     */
    public function store($data){
        return $this->postRepository->store($data);
    }

    /**
     * Update specific post.
     *
     * @return boolean
     */
    public function update($data, $slug)
    {
        return $this->postRepository->update($data, $slug);
    }

    /**
     * Delete specific post.
     *
     * @return boolean
     */
    public function delete($slug)
    {
        return $this->postRepository->delete($slug);
    }

    /**
     * Delete specific post.
     *
     * @return void
     */
    public function storePostImages($images, $post)
    {
        foreach($images as $image) {
            $imagePath = $this->uploadImageService->uploadImage($image, 'posts/'.$post->slug);
            $this->postRepository->storePostImage($imagePath, $post->id);
        }
    }

}
