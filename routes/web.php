<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Post;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post routes that require authentication
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Public post routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// User posts
Route::get('/user/{id}/posts', function ($id) {
    $user = User::find($id);
    $posts = $user->posts; // Get all posts by the user

    return response()->json($posts); // Return the posts as a JSON response
});

// Profile routes
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

// Comment routes
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comment/{id}', [CommentController::class, 'show'])->name('comment.show');
Route::get('/comment/{id}/post', [PostController::class, 'commentDetails'])->name('comment.post');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');


require __DIR__.'/auth.php';
