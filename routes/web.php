<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\Admin\CategoryController;
use App\http\Controllers\Admin\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\ForumController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/checkout/{product}', [CheckoutController::class,'store'])
        ->name('checkout.store');

    Route::get('/my-orders', [CheckoutController::class,'myOrders'])
        ->name('orders.mine');
   
    Route::get('/forum', [ThreadController::class,'index'])->name('forum.index');
    Route::get('/forum/create', [ThreadController::class,'create'])->name('forum.create');
    Route::post('/forum', [ThreadController::class,'store'])->name('forum.store');
    Route::get('/forum/{thread}', [ThreadController::class,'show'])->name('forum.show');
    Route::post('/forum/{thread}/comment', [CommentController::class,'store'])
        ->name('forum.comment');
    Route::delete('/comments/{comment}', [CommentController::class,'destroy'])
    ->name('comments.destroy')
    ->middleware('auth');
});


Route::get('/', [ProductPageController::class, 'index'])
    ->name('home');
Route::get('/products', [ProductPageController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductPageController::class, 'show'])->name('products.show');  

Route::middleware(['auth','isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');
        Route::resource('/categories', CategoryController::class);
        Route::resource('/products', ProductController::class);
        Route::resource('/reviews', AdminReviewController::class)->only(['index', 'destroy']);
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)
    ->only(['index','update']);
    Route::resource('forums', ForumController::class)
    ->only(['index','show','destroy']);

Route::delete('forums/comments/{comment}',
    [ForumController::class,'destroyComment'])
    ->name('forums.comments.destroy');

    });

Route::middleware(['auth'])->group(function () {
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});



require __DIR__.'/auth.php';
