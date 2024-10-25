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

    public function showAllPosts()
    {
        $postModel = new Post();
        $posts = $postModel->getAllPostsRawSQL();
        return $posts;
        
    }

    public function insertPostWithSql()
    {
        $dummyData = [
            (object)[
                'user_id' => 1,
                'title' => 'タイトル1',
                'body' => '本文1'
            ],
            (object)[
                'user_id' => 1,
                'title' => 'タイトル2',
                'body' => '本文2'
            ],
            (object)[
                'user_id' => 1,
                'title' => 'タイトル3',
                'body' => '本文3'
            ],
        ];
        
        $postModel = new Post();
        foreach ($dummyData as $data) {
            $postModel->insertPost($data);
        }
    }

    public function createAllPostWithTransaction()
    {
        $postModel = new Post();
        $postModel->createAllPostsRawSQLWithTransaction();
    }

    public function updatePostWithSql() 
    {
       $dummyData = [
            (object)[
                'id' => 12,
                'title' => 'タイトル更新1',
                'body' => '本文更新1'
            ],
            (object)[
                'id' => 13,
                'title' => 'タイトル更新2',
                'body' => '本文更新2'
            ],
            (object)[
                'id' => 14,
                'title' => 'タイトル更新3',
                'body' => '本文更新3'
            ],
        ];
        
        $postModel = new Post();
        foreach ($dummyData as $data) {
            $postModel->updatePost($data);
        }
    }

    public function deletePostwithSql() 
    {
        $dummyData = (object) [
            'id' => 12,
        ];
        $postModel = new Post();
        $postModel->deletePost($dummyData);
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
