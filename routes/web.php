<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/posts', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('post.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get(
        '/posts/show/{id}',
        [PostController::class, 'show']
    );
    
    Route::get(
        '/post/create',
        [PostController::class, 'create']
    );
    
    Route::post(
        '/post/create',
        [PostController::class, 'store']
    );
    
    Route::get(
        '/post/edit/{id}',
        [PostController::class, 'edit']
    );
    
    Route::post(
        '/post/update',
        [PostController::class, 'update']
    );
    
    Route::post(
        '/post/delete/{id}',
        [PostController::class, 'destroy']
    );
    
    Route::post(
        '/post/images/{id}',
        [PostController::class, 'storeImage']
    );    
});

Route::get('login/github', [SocialLoginController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [SocialLoginController::class, 'handleGithubCallback']);

Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);   
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout'); 

    Route::middleware('auth:admin')->group(function() {
        Route::get('dashboard', function() {
            return view('admin.dashboard');
        })->name('dashboard');
    });
});

require __DIR__.'/auth.php';
