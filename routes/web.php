<?php

use App\Models\Book;
use App\Models\Author;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

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

Route::get('/index', function () {
    return view('index');
})->name('index');

/*
Route::group([
    'prefix'=> 'authors',
    'controller' => AuthorController::class
], function () {
    Route::get('/create','create')->name('authors.create');
    Route::post('/','store')->name('authors.store');
    Route::get('{id}','show')->name('authors.show');
    Route::get('/{id}/edit','edit')->name('authors.edit');
    Route::put('/{id}','update')->name('authors.update');
    Route::delete('/{id}/delete','destroy')->name('authors.destroy');
});

Route::group([
    'prefix'=> 'books',
    'controller' => BookController::class
], function () {
    Route::get('/create','create')->name('books.create');
    Route::post('/','store')->name('books.store');
    Route::get('{id}','show')->name('books.show');
    Route::get('/{id}/edit','edit')->name('books.edit');
    Route::put('/{id}','update')->name('books.update');
    Route::delete('/{id}/delete','destroy')->name('books.destroy');
});
*/
