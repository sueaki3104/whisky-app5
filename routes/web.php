<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ShelvesController;


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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/tweet', [TweetController::class, 'index'])->name('tweet.index');
    Route::get('/tweet/search/input', [SearchController::class, 'create'])->name('search.input');

    Route::get('/shelves/index', [ShelvesController::class, 'index'])->name('shelves.index');
    Route::get('/shelves/show/{id}', [ShelvesController::class, 'show'])->name('shelves.show');
    Route::get('/shelves/register', [ShelvesController::class, 'register'])->name('shelves.register');
    Route::post('/shelves/store', [ShelvesController::class, 'store'])->name('shelves.store');
    Route::get('/shelves/delete/{id}', [ShelvesController::class, 'delete'])->name('shelves.delete');

    Route::get('/tweet/search/result', [SearchController::class, 'index'])->name('search.result');
    Route::get('/tweet/search/result2', [SearchController::class, 'searchPrefecture'])->name('search.prefecture');
    Route::get('/tweet/search/result3', [SearchController::class, 'searchPrefecture3'])->name('search.prefecture3');
    Route::get('/tweet/timeline', [TweetController::class, 'timeline'])->name('tweet.timeline');
    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    Route::post('tweet/{tweet}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('tweet/{tweet}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::get('/tweet/mypage', [TweetController::class, 'mydata'])->name('tweet.mypage');
    Route::resource('tweet', TweetController::class);
    Route::resource('comment', CommentController::class);
});

Route::get('/', function () {
    return view('toppage');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile2', [ProfileController::class, 'update_prefecture'])->name('profile.update_prefecture');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
