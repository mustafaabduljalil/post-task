<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','image'];

    /**
     * Return image's post
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
     * Set full path for image
     */
    public function getImageAttribute($value)
    {
        return url('storage/'.$value);
    }
}
