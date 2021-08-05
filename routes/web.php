<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\FavouriteController;

//use App\Http\Controllers\Admin\DashboardController;
//use App\Http\Controllers\Author\DashboardController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\FavouriteController as AdminFavorite;
use App\Http\Controllers\Admin\SubscribeController as AdmimSubscribeController;
use App\Http\Controllers\Admin\CommentController as AdmimCommentController;

use App\Http\Controllers\Author\PostController as AuthorPost;
use App\Http\Controllers\Author\SettingsController as AuthorSettings;
use App\Http\Controllers\Author\CommentController as AuthorCommentController;
use App\Http\Controllers\Author\FavouriteController as AuthorFavouriteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/post/{slug}', [App\Http\Controllers\PostController::class, 'postDetail'])->name('post.detail');

Route::get('/category/{slug}', [App\Http\Controllers\PostController::class, 'postByCategory'])->name('category.posts');
Route::get('/tag/{slug}', [App\Http\Controllers\PostController::class, 'postByTag'])->name('tag.posts');
Route::get('/profile/{username}', [App\Http\Controllers\AuthorController::class, 'profile'])->name('author.profile');
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::post('/subscribe', [SubscribeController::class, 'store'])->name('store.subscribe');

Auth::routes();
Route::group([ 'middleware' => ['auth'] ], function () {
    Route::post('comment/{post}', [CommentController::class, 'store'])->name('store.comment');
    Route::post('favourite/{post}', [FavouriteController::class, 'favourite'])->name('post.favorite');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth', 'admin'] ], function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/update-profile', [SettingsController::class, 'updateProfile'])->name('update.profile');
    Route::put('/update-password', [SettingsController::class, 'updatePassword'])->name('update.password');

    Route::resource('tag', TagController::class);
    Route::resource('category', CategoryController::class);    
    Route::resource('post', PostController::class);

    Route::get('pending/post', [PostController::class, 'pending'])->name('pending.post');
    Route::put('/post/{id}/approve', [PostController::class, 'approval'])->name('post.approve');

    Route::get('/authors', [AuthorController::class, 'index'])->name('author.index');
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');

    Route::get('/favorite', [AdminFavorite::class, 'index'])->name('index.favorite');
    Route::get('/subscribe', [AdmimSubscribeController::class, 'index'])->name('subscribe.index');
    Route::delete('/subscribe/{id}', [AdmimSubscribeController::class, 'destroy'])->name('subscribe.destroy');

    Route::get('/comment', [AdmimCommentController::class, 'index'])->name('index.comment');
    Route::delete('/comment/{id}', [AdmimCommentController::class, 'destroy'])->name('destroy.comment');

});

Route::group(['as' => 'author.', 'prefix' => 'author', 'middleware' => ['auth', 'author'] ], function () {
    Route::get('/dashboard', [App\Http\Controllers\Author\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('post', AuthorPost::class );

    Route::get('/settings', [AuthorSettings::class, 'index'])->name('settings');
    Route::put('/update-profile', [AuthorSettings::class, 'updateProfile'])->name('update.profile');
    Route::put('/update-password', [AuthorSettings::class, 'updatePassword'])->name('update.password');

    Route::get('/comment', [AuthorCommentController::class, 'index'])->name('index.comment');
    Route::delete('/comment/{id}', [AuthorCommentController::class, 'destroy'])->name('destroy.comment');

    Route::get('/favorite', [AuthorFavouriteController::class, 'index'])->name('index.favorite');

});

view()->composer('layouts.frontend.partials.footer', function ($view) {
    $categories = App\Models\Category::all();
    $view->with('categories', $categories);
});

