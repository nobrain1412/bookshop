<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostTypeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\UserController;

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
Route::match(["get","post"],"/login",[AuthController::class,"login"])->name("login");
Route::match(["get","post"],"/register",[AuthController::class,"register"])->name("register");
Route::get('/logout',[AuthController::class,'logout'])->name('logout');
//cart
Route::match(["get","post"],'/cart',[UserController::class,"cart"])->name('cart');
Route::match(['get','post'],'/add-to-cart/{id}',[UserController::class,"addCart"])->name('cart.add');
//client

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('home')->group(function () {
    Route::get('/author', [\App\Http\Controllers\Client\AuthorController::class, 'index'])->name('home.author');
    Route::get('book-detail/{id}', [\App\Http\Controllers\Client\BookController::class, 'bookDetail'])->name('home.book-detail');
});
Route::get('/product', function () {
    return view('client.products');
})->name('product');
//Route::get('/productdetail', function () {
//    return view('client.productdetail');
//})->name('/productDetail');
Route::get('/newslist', function () {
    return view('client.newslist');
})->name('newsList');
Route::get('/newsgrid', function () {
    return view('client.newsgrid');
})->name('newsGrid');
Route::get('/newsdetail', function () {
    return view('client.newsdetail');
})->name('newsdetail');
Route::get('/contactus', function () {
    return view('client.contactus');
})->name('contactus');
Route::get('/authordetail', function () {
    return view('client.authordetail');
})->name('authorDetail');
Route::get('/aboutus', function () {
    return view('client.aboutus');
})->name('aboutUs');
Route::get('/error', function () {
    return view('client.404error');
})->name('error');
Route::get('/comingsoon', function () {
    return view('client.comingsoon');
})->name('comingSoon');

//profile
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::match(["get", "post"], "/update-profile", [UserController::class, "updateProfile"])->name("profile.update");
Route::match(["get", "post"], "/change-password", [UserController::class, "changePassword"])->name("profile.changePassword");
//admin
Route::prefix('admin')->group(function () {
    /*
     * Module Category
     */
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.add');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    });
    Route::prefix('post-type')->group(function () {
        Route::get('/', [PostTypeController::class, 'index'])->name('post-type.index');
        Route::get('/create', [PostTypeController::class, 'create'])->name('post-type.add');
        Route::post('/store', [PostTypeController::class, 'store'])->name('post-type.store');
        Route::get('/edit/{id}', [PostTypeController::class, 'edit'])->name('post-type.edit');
        Route::post('/update/{id}', [PostTypeController::class, 'update'])->name('post-type.update');
        Route::get('/destroy/{id}', [PostTypeController::class, 'destroy'])->name('post-type.destroy');
    });
    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('post.index');
        Route::get('/create', [PostController::class, 'create'])->name('post.add');
        Route::post('/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::get('/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
    });
    Route::prefix('book')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('book.index');
        Route::get('/create', [BookController::class, 'create'])->name('book.add');
        Route::post('/store', [BookController::class, 'store'])->name('book.store');
        Route::get('/edit/{id}', [BookController::class, 'edit'])->name('book.edit');
        Route::get('/destroy/{id}', [BookController::class, 'destroy'])->name('book.destroy');
        Route::post('/update/{id}', [BookController::class, 'update'])->name('book.update');
    });
    Route::prefix('author')->group(function () {
        Route::get('/', [AuthorController::class, 'index'])->name('author.index');
        Route::get('/create', [AuthorController::class, 'create'])->name('author.add');
        Route::post('/store', [AuthorController::class, 'store'])->name('author.store');
        Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('author.edit');
        Route::get('/destroy/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');
        Route::post('/update/{id}', [AuthorController::class, 'update'])->name('author.update');
    });
});

