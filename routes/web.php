<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get(
    '/user/{id}',
    User::class . '@getUserById'
);

Route::get(
    '/posts',
    [PostController::class, 'index']
);

Route::post(
    '/posts/create/bulk',
    [PostController::class, 'createAllPostWithTransaction']
);

Route::get(
    '/posts2',
    [PostController::class, 'index2']
);

Route::get(
    '/posts3',
    [PostController::class, 'showAllPosts']
);

Route::post(
    '/create/normalsql',
    [PostController::class, 'insertPostWithSql']
);

Route::post(
    '/update/normalsql',
    [PostController::class, 'updatePostWithSql']
);

Route::post(
    '/delete/normalsql',
    [PostController::class, 'deletePostWithSql']
);

Route::post(
    '/posts/create/querybuilder',
    [PostController::class, 'createPostsWithQueryBuilder']
);

Route::get(
    '/posts/get/querybuilder',
    [PostController::class, 'getPostsWithQueryBuilder']
);

Route::post(
    '/posts/update/querybuilder',
    [PostController::class, 'updatePostWithQueryBuilder']
);

Route::post(
    '/posts/delete/querybuilder/{id}',
    [PostController::class, 'deletePostWithQueryBuilder']
);

Route::get(
    '/posts/get/querybuilderwithfilter',
    [PostController::class, 'getPostByFilter']
);

Route::get(
    '/posts/get/querybuilder/count',
    [PostController::class, 'getPostsCount']
);

Route::get(
    '/posts/show/querybuilder/join',
    [PostController::class, 'getPostsWithJoin']
);

Route::get(
    '/posts/get/querybuilder/{id}',
    [PostController::class, 'getPostById']
);

Route::post(
    '/posts/get/eloquent/create',
    [PostController::class, 'createPostWithEloquent']
);

Route::post(
    '/posts/update/eloquent',
    [PostController::class, 'updatePostWithEloquent']
);

Route::post(
    '/posts/delete/eloquent/{id}',
    [PostController::class, 'deletePostWithEloquent']
);
// Route::get(
//     '/posts',
//     [PostController::class, 'create']
// );
