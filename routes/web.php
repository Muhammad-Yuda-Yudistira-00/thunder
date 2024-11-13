<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\AdminDashboardController;
// use App\Http\Controllers\AnimeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('home');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/dashboard/{slug}', [DashboardController::class, 'show'])->name('dashboard.show');
    Route::post('/dashboard/{slug}', [PostController::class, 'store'])->name('post.store');

    // Comment
    Route::post('/comments/{post_id}', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment_id}/reply', [CommentController::class, 'reply'])->name('comments.reply');
    Route::delete('/comments/{comment_id}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Like dan Unlike
    Route::post('/posts/{post_id}/like', [LikeController::class, 'likePost'])->name('posts.like');
    Route::post('/posts/{post_id}/unlike', [LikeController::class, 'unlikePost'])->name('posts.unlike');

    Route::post('/comments/{comment_id}/like', [LikeController::class, 'likeComment'])->name('comments.like');
    Route::post('/comments/{comment_id}/unlike', [LikeController::class, 'unlikeComment'])->name('comments.unlike');

    // Bookmark
    Route::post('/posts/{post_id}/bookmark', [BookmarkController::class, 'bookmarkPost'])->name('posts.bookmark');
    Route::post('/posts/{post_id}/remove-bookmark', [BookmarkController::class, 'removeBookmarkPost'])->name('posts.remove-bookmark');

    // Super Admin OR Admin
    Route::middleware(['role:super-admin|admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::put('/admin/dashboard', [AdminDashboardController::class, 'update'])->name('admin.dashboard.update');

        // Super Admin
        Route::middleware(['role:super-admin'])->group(function () {
            //
        });
    });
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
