<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;

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

// Route::any('{slug}',function () {
//     return view('welcome');
// });

    // Book Managment Routes
// Route::group(['middleware' => ['checkAdmin']], function () {
Route::post('/books/create',[BooksController::class, 'create']);
Route::get('/books/get_books',[BooksController::class, 'get_books']);
Route::post('/books/edit',[BooksController::class, 'edit']);
Route::post('/books/delete',[BooksController::class, 'delete']);
Route::post('/books/upload',[BooksController::class, 'upload']);
Route::post('/books/imagedelete',[BooksController::class, 'deleteimage']);

//user managment routes
Route::post('/users/create',[UserController::class, 'create']);
Route::get('/users/get_users',[UserController::class, 'get_users']);
Route::post('/users/edit',[UserController::class, 'edit']);
Route::post('/users/delete',[UserController::class, 'delete']);
Route::post('/users/admin_login',[UserController::class, 'adminLogin']);

// });



Route::get('/logout',[UserController::class, 'logout']);
Route::get('/',[UserController::class, 'index']);
Route::any('/login',[UserController::class, 'index']);


// for frontend work
Route::get('/book',[MainController::class, 'bookpage']);
Route::get('/main/{$id}',[MainController::class, 'bookdetail']);
Route::post('/main/bookserach',[MainController::class, 'booksearch']);
