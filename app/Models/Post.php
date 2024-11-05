<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
    ];

    // relation with users
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // relation with tags
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // public function createPost($data)
    // {
    //     $post = new Post();
    //     $post->title = $data->title;
    //     $post->body = $data->body;
    //     $post->save();
    //     return $post;
    // }

    // public function getAllPostsRawSQL()
    // {
    //     $posts = DB::select('SELECT * FROM posts');
    //     // dd($posts);  
    //     return $posts;
    // }
    // // データの挿入をするメソッド
    // public function insertPost($data)
    // {
    //     // SQL injection対策のため
    //     $post = DB::insert('INSERT INTO posts (user_id, title, body, created_at = ?) VALUES (?, ?, ?)', [$data->user_id, $data->title, $data->body, now()]);
    //     return $post;
    // }

    // // データの更新をするメソッド
    // public function updatePost($data)
    // {
    //     // SQL injection対策のため
    //     $post = DB::update('UPDATE posts SET title = ?, body = ?, updated_at = ? WHERE id = ?', [$data->title, $data->body, now(), $data->id]);
    //     return $post;
    // }

    // // データの削除をするメソッド
    // public function deletePost($data)
    // {
    //     // SQL injection対策のため
    //     $post = DB::delete('DELETE FROM posts WHERE id = ?', [$data->id]);
    //     return $post;
    // }

    // // create all data with use transaction
    // public function createAllPostsRawSQLWithTransaction()
    // {
    //     // DB::transaction(function() {
    //         $user_id = 1;
    //         $title = 'トランザクション成功';
    //         $body = 'これはトランザクション成功です';

    //         DB::insert('INSERT INTO posts (user_id, title, body, created_at) VALUES (?, ?, ?, ?)', [$user_id, $title, $body, now()]);

    //         $title = 'トランザクション失敗';
    //         $body = 'これはトランザクション失敗です';

    //         DB::insert('INSERT INTO posts (title, body, created_at) VALUES (?, ?, ?)', [$title, $body, now()]);
    //     // }); 
    // }

    // // create post data with query builder
    // public function createPostWithQueryBuilder($data)
    // {
    //     $post = DB::table('posts')->insert([
    //         'user_id' => $data->user_id,
    //         'title' => $data->title,
    //         'body' => $data->body,
    //         'created_at' => now(),
    //         'updated_at' => now()
    //     ]);
    //     return $post;
    // }

    // // get all posts with query builder
    // public function getAllPostsWithQueryBuilder()
    // {
    //     $posts = DB::table('posts')->get();
    //     // dd($posts);
    //     return $posts;
    // }
    
    // // update post data with query builder 
    // public function updatePostWithQueryBuilder($data)
    // {
    //     $post = DB::table('posts')
    //         ->where('id', $data->id)
    //         ->update([
    //             'title' => $data->title,
    //             'body' => $data->body,
    //             'updated_at' => now()
    //         ]);
    //     return $post;
    // }

    // // delete post data with query builder
    // public function deletePostWithQueryBuilder($id)
    // {
    //     $post = DB::table('posts')
    //         ->where('id', $id)
    //         ->delete();
    //     return $post;
    // }

    // // get post data with query builder use where method
    // public function getPostByFilterWithQueryBuilder()
    // {
    //     // $post = DB::table('posts')
    //     //     ->where('body', 'like', '%更新%')
    //     //     ->get();

    //     // pagination
    //     $posts = DB::table('posts')
    //         ->paginate(5);
    //     return $posts;
    // }   

    // public function countPosts()
    // {
    //     $count = DB::table('posts')->count();
    //     return $count;
    // }

    // // join table posts and users
    // public function getPostsWithJoin()
    // {
    //     $posts = DB::table('posts')
    //         ->join('users', 'posts.user_id', '=', 'users.id')
    //         ->select('posts.*', 'users.name')
    //         ->get();
    //     return $posts;
    // }

    // // get post data by find method(eloquent)
    // public function getPostById()
    // {
    //     $post = Post::get();
    //     return $post;
    // }

    // create post data with eloquent
    public function createPostWithEloquent($data) : Post 
    {
        // Log::debug(print_r($data, true));
        $user_id = 1;
        $post = new Post();
        // $post->user_id = $data->user_id;
        $post->user_id = $user_id;
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->save();

        return $post;
    }

    // update post data with eloquent
    public function updatePostWithEloquent($data) : Post
    {
        $post = Post::find($data['id']);
        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->save();
        return $post;       
    }

    // delete post data with eloquent
    public function deletePostWithEloquent($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $post;
    }

    // get post data with eager loading
    public function getPostWithEagerLoading()
    {
        $posts = Post::with('tags')->get();
        return $posts;
    }

}
