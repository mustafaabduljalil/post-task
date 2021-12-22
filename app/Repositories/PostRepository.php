<?php


namespace App\Repositories;

use App\Models\Post;
use App\Models\PostImage;

class PostRepository
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Retrieve posts list.
     *
     * @return array
     */
    public function list($relations = null)
    {
        return Post::when($relations,function ($query) use ($relations) {
            $query->with($relations);
        })->where('user_id',auth()->id())->get();
    }

    /**
     * Retrieve only one post.
     *
     * @return object
     */
    public function getOnePost($slug)
    {
        return $this->post->where('slug',$slug)->first();
    }

    /**
     * Store new post.
     *
     * @return \App\Models\Post $post
     */
    public function store($data)
    {
        return $this->post->create($data);
    }

    /**
     * Update specific post.
     *
     * @return boolean
     */
    public function update($data, $slug)
    {
        return $this->post->where('slug',$slug)->update($data);
    }

    /**
     * Delete specific post.
     *
     * @return boolean
     */
    public function delete($slug)
    {
        return $this->post->where('slug',$slug)->delete();
    }

    /**
     * Store post image.
     *
     * @return object
     */
    public function storePostImage($imagePath, $postId)
    {
        return PostImage::create([
            'image' => $imagePath,
            'post_id' => $postId
        ]);
    }

}
