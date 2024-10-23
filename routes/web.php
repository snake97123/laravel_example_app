<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
    '/posts',
    [PostController::class, 'index']
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
// Route::get(
//     '/posts',
//     [PostController::class, 'create']
// );
