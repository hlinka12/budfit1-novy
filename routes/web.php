<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LikeController;
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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('',[PageController::class, 'index']);
Route::get('/about',[PageController::class, 'about']);

Route::resources([
    'articles' => ArticleController::class,
]);

//Route::resources([
//    'load'=> CommentController::class,
//]);

Route::post('/load/add',[CommentController::class, 'store'])->name('comment.add');
Route::delete('/load/delete/{id}',[CommentController::class, 'destroy'])->name('comment.delete');

Route::get('/edit/user/',[UserController::class, 'edit']);
Route::post('/edit/user/',[UserController::class, 'update']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::post('/articles/like/{article}',[LikeController::class, 'store'])->name('article.like');
//Route::delete('/articles/like/{article}',[LikeController::class, 'destroy'])-> name('article.like');