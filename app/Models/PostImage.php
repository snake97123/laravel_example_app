<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'url',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function saveImage($data, $postId): PostImage
    {
        $postImage = new PostImage();
        $postImage->post_id = $postId;
        // $postImage->url = $data->file('image')->store('public/images');
        $postImage->url = $data->store('public/images');
        $postImage->save();
        return $postImage;
    }
}
