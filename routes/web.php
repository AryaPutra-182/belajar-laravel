<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticlePageController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ReviewController;

// ADMIN
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// LANDING PAGE
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// PRODUK
Route::get('/products', [ProductPageController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product}', [ProductPageController::class, 'show'])
    ->name('products.show');

// ARTIKEL
Route::get('/articles', [ArticlePageController::class,'index'])
    ->name('articles.index');

Route::get('/articles/{article}', [ArticlePageController::class,'show'])
    ->name('articles.show');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (USER LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/user/dashboard', [UserDashboardController::class,'index'])
        ->name('user.dashboard');

    Route::post('/checkout/{product}', [CheckoutController::class,'store'])
        ->name('checkout.store');

    Route::get('/my-orders', [CheckoutController::class,'myOrders'])
        ->name('orders.mine');

    // FORUM
    Route::get('/forum', [ThreadController::class,'index'])->name('forum.index');
    Route::get('/forum/create', [ThreadController::class,'create'])->name('forum.create');
    Route::post('/forum', [ThreadController::class,'store'])->name('forum.store');
    Route::get('/forum/{thread}', [ThreadController::class,'show'])->name('forum.show');
    Route::post('/forum/{thread}/comment', [CommentController::class,'store'])
        ->name('forum.comment');

    Route::delete('/comments/{comment}', [CommentController::class,'destroy'])
        ->name('comments.destroy');

    // REVIEW PRODUK
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('articles', ArticleController::class);
        Route::resource('orders', OrderController::class)
            ->only(['index','update']);
            Route::resource('reviews', AdminReviewController::class)
    ->only(['index','destroy']);

        // ❌ TIDAK ADA FORUM DI SINI
    });


    Route::middleware(['auth','isMasterAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        

        Route::resource('forums', ForumController::class)
            ->only(['index','show','destroy']);

        Route::delete('forums/comments/{comment}',
            [ForumController::class,'destroyComment'])
            ->name('forums.comments.destroy');
    });


require __DIR__.'/auth.php';
