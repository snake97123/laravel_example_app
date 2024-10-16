<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function createPost($data)
    {
        $post = new Post();
        $post->image_path = $data['image_path'];
        $post->caption = $data['caption'];
        $post->save();
        return $post;
    }
}
