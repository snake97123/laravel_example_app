<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostImage;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostImageController extends Controller
{
    public function store(Request $request, $postId)
    {
      // Log::debug(print_r($request->all(), true)); 
       $request->validate([
        // imageフィールドにはファイルが必須であること、ファイルであること、画像ファイルであること、拡張子がjpeg,png,gifであることを指定
        'images' => 'required|array',
        'images.*' => 'file|image|mimes:jpeg,png,gif|max:5120'
       ]);
       
       Log::debug(print_r($request->all(), true)); 
       $post = Post::findOrFail($postId);
      
       // multiple image file upload
        //  if ($request->hasFile('image')) {
        //       $images = $request->file('image');
        //       foreach ($images as $image) {
               
        //       }
        //  }

         $postImage = new PostImage();

         $images = $request->file('images');
         foreach($images as $image) {
            $postImage->saveImage($image, $postId);
         }

        //  $result = $postImage->saveImage($request->all(), $postId);

      //  return redirect()->route('posts.index');
    }
     
}
