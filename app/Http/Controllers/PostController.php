<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        //投稿のダミーデータ作成。オブジェクトでタイトルとボディーを含む
        $posts = [
            (object)[
                'title' => 'タイトル1',
                'body' => '本文1'
            ],
            (object)[
                'title' => 'タイトル2',
                'body' => '本文2'
            ],
            (object)[
                'title' => 'タイトル3',
                'body' => '本文3'
            ],
        ];

        return view('posts.index', [
            'posts' => $posts
        ]); 
    }

    public function index2()
    {
        $posts = [
            (object)[
                'title' => 'タイトル1',
                'body' => '本文1'
            ],
            (object)[
                'title' => 'タイトル2',
                'body' => '本文2'
            ],
            (object)[
                'title' => 'タイトル3',
                'body' => '本文3'
            ],
        ];

        return view('posts.index2', [
            'posts' => $posts
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'caption' => 'nullable|string|max:255',
        ]);

        // 画像の保存
        $path = $request->file('image')->store('public/images');

        $post = new Post();
        return $post->createPost(
            $request->all()
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
