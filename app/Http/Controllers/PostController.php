<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         // 投稿データを取得し、関連する画像を最新の更新日時に基づいて取得する
         $posts = Post::with(['postImages' => function ($query) {
             // 最新の更新日時に一致する画像のみを取得する条件を追加
             $query->whereIn('updated_at', function ($subQuery) {
                 // 各 post_id ごとに最大の updated_at（最新の更新日時）をサブクエリで取得
                 $subQuery->selectRaw('MAX(updated_at)')
                          ->from('post_images')
                          // サブクエリ内の post_id と外側のクエリの post_id が一致するように制約
                          ->whereColumn('post_id', 'post_images.post_id')
                          // 各 post_id ごとにグループ化して最新の日時を取得
                          ->groupBy('post_id');
             });
         }])->get();
     
         return view('posts.index', [
             'posts' => $posts
         ]); 
     }
     

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $result = $post->createPostWithEloquent($request->validated());

        // Log::debug('Request all data: ' . print_r($request->all(), true));
        // Log::debug('Request files: ' . print_r($request->file('images'), true));
        //$resultと$request->all()の中身を確認
        // image upload 
        if ($request->hasFile('images')) {
               $postImage = new PostImageController();
               $postImage->store($request, $result->id);
            }
        $result->save();

        session()->flash('success', '投稿は正常に作成されました');

        return redirect('/posts');
    }

    public function show($id)
    {
        // 投稿データを取得し、関連する最新の画像のみをロード
        $post = Post::with(['postImages' => function ($query) {
            // 各 post_id ごとに最新の更新日時に一致する画像を取得
            $query->whereIn('updated_at', function ($subQuery) {
                // 現在の post_id に対応する最新の updated_at を取得
                $subQuery->selectRaw('MAX(updated_at)')
                         ->from('post_images')
                         ->whereColumn('post_id', 'post_images.post_id')
                         ->groupBy('post_id');
            });
        }])->findOrFail($id);
    
        return view('posts.show', [
            'post' => $post
        ]);
    }
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        // use policy
        $this->authorize('update', $post); 
        // Log::debug(print_r($post, true));
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    public function update(StorePostRequest $request) 
    {
        $request->validate([
            'id' => 'required|integer', 
            'images.*' => 'file|image|mimes:jpeg,png,gif|max:5120'
        ]);

        $post = new Post();
        $result = $post->updatePostWithEloquent($request->validated());
        if ($request->hasFile('images')) {
            $postImage = new PostImageController();
            $postImage->store($request, $result->id);
         }
        $result->save();

        session()->flash('success', '投稿は正常に更新されました');

        return redirect('/posts');

    }

    public function destroy($id)
    {
        $post = new Post();
        $result = $post->deletePostWithEloquent($id);
        if($result) {
            session()->flash('success', '投稿は正常に削除されました');
        }
        return redirect('/posts');
    }

    // public function index2()
    // {
    //     $posts = [
    //         (object)[
    //             'title' => 'タイトル1',
    //             'body' => '本文1'
    //         ],
    //         (object)[
    //             'title' => 'タイトル2',
    //             'body' => '本文2'
    //         ],
    //         (object)[
    //             'title' => 'タイトル3',
    //             'body' => '本文3'
    //         ],
    //     ];

    //     return view('posts.index2', [
    //         'posts' => $posts
    //     ]); 
    // }

    // public function showAllPosts()
    // {
    //     $postModel = new Post();
    //     $posts = $postModel->getAllPostsRawSQL();
    //     return $posts;
        
    // }

    // public function insertPostWithSql()
    // {
    //     $dummyData = [
    //         (object)[
    //             'user_id' => 1,
    //             'title' => 'タイトル1',
    //             'body' => '本文1'
    //         ],
    //         (object)[
    //             'user_id' => 1,
    //             'title' => 'タイトル2',
    //             'body' => '本文2'
    //         ],
    //         (object)[
    //             'user_id' => 1,
    //             'title' => 'タイトル3',
    //             'body' => '本文3'
    //         ],
    //     ];
        
    //     $postModel = new Post();
    //     foreach ($dummyData as $data) {
    //         $postModel->insertPost($data);
    //     }
    // }

    // public function createAllPostWithTransaction()
    // {
    //     $postModel = new Post();
    //     $postModel->createAllPostsRawSQLWithTransaction();
    // }

    // // Call the createPostWithQuery method in the model
    // public function createPostsWithQueryBuilder()
    // {
    //     $data = (object)[
    //             'user_id' => 1,
    //             'title' => 'クエリービルダー',
    //             'body' => 'クエリビルダーの練習です。'
    //     ];

    //     $postModel = new Post();
    //     $postModel->createPostWithQueryBuilder($data);
    // }

    // // Call the getPostWithQueryBuilder method in the model
    // public function getPostsWithQueryBuilder()
    // {
    //     $postModel = new Post();
    //     $posts = $postModel->getAllPostsWithQueryBuilder();
    //     return $posts;
    // }
    
    // // Call the updatePostWithQueryBuilder method in the model
    // // There is only one set of data to update
    // public function updatePostWithQueryBuilder()
    // {
    //     $data = (object)[
    //         'id' => 11, 
    //         'title' => 'クエリービルダー更新',
    //         'body' => 'クエリビルダーの練習です。更新しました。'
    //     ];

    //     $postModel = new Post();
    //     $postModel->updatePostWithQueryBuilder($data);
    // } 

    // // Call the deletePostWithQueryBuilder method in the model
    // public function deletePostWithQueryBuilder($id)
    // {
    //     $postModel = new Post();
    //     $postModel->deletePostWithQueryBuilder($id);
    // }

    // // Call the getPostByFilterWithQueryBuilder method in the model
    // public function getPostByFilter()
    // {
    //     $postModel = new Post();
    //     $posts = $postModel->getPostByFilterWithQueryBuilder();
    //     return $posts;
    // }


    // public function updatePostWithSql() 
    // {
    //    $dummyData = [
    //         (object)[
    //             'id' => 12,
    //             'title' => 'タイトル更新1',
    //             'body' => '本文更新1'
    //         ],
    //         (object)[
    //             'id' => 13,
    //             'title' => 'タイトル更新2',
    //             'body' => '本文更新2'
    //         ],
    //         (object)[
    //             'id' => 14,
    //             'title' => 'タイトル更新3',
    //             'body' => '本文更新3'
    //         ],
    //     ];
        
    //     $postModel = new Post();
    //     foreach ($dummyData as $data) {
    //         $postModel->updatePost($data);
    //     }
    // }

    // public function deletePostwithSql() 
    // {
    //     $dummyData = (object) [
    //         'id' => 12,
    //     ];
    //     $postModel = new Post();
    //     $postModel->deletePost($dummyData);
    // }

    // public function getPostsCount()
    // {
    //     $postModel = new Post();
    //     $count = $postModel->countPosts();
    //     return $count;
    // }
    
    // // join table posts and users use Post model's method
    // public function getPostsWithJoin()
    // {
    //     $postModel = new Post();
    //     $posts = $postModel->getPostsWithJoin();
    //     return $posts;
    // }

    // // get data by getPostById method in the model
    // public function getPostById()
    // {
        
    //     $postModel = new Post();
    //     $post = $postModel->getPostById();
    //     return $post;
    // }

    // // get data by createPostWithEloquent method in the model
    // public function createPostWithEloquent()
    // {
    //     $data = (object)[
    //         'user_id' => 1,
    //         'title' => 'エロクアント',
    //         'body' => 'エロクアントの練習です。'
    //     ];

    //     $postModel = new Post();
    //     $postModel->createPostWithEloquent($data);
    // }

    // // update data by updatePostWithEloquent method in the model
    // public function updatePostWithEloquent()
    // {
    //     $data = (object)[
    //         'id' => 18,
    //         'title' => 'エロクアント更新',
    //         'body' => 'エロクアントの練習です。更新しました。'
    //     ];

    //     $postModel = new Post();
    //     $postModel->updatePostWithEloquent($data);
    // }

    // // delete data by deletePostWithEloquent method in the model
    // public function deletePostWithEloquent($id)
    // {
    //     $postModel = new Post();
    //     $postModel->deletePostWithEloquent($id);
    // }



    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image',
    //         'caption' => 'nullable|string|max:255',
    //     ]);

    //     // 画像の保存
    //     $path = $request->file('image')->store('public/images');

    //     $post = new Post();
    //     return $post->createPost(
    //         $request->all()
    //     );
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Post $post)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Post $post)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Post $post)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Post $post)
    // {
    //     //
    // }
}
