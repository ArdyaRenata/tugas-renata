<?php

use Illuminate\Support\Facades\Route;
use App\Controllers\Controller;
use App\Http\Controllers\BlogController;


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

Route::get('/hello', function () {
    return 'Hello World';
});

Route::get('/belajar', function () {
    echo '<h1>Hello World</h1>';
    echo '<p>Sedang Belajar Laravel</p>';
});

Route::get('/siswa/rpl/renata', function () {
    echo '<h2 style="text-align: center"><u>Welcome to Laravel, Renata</u></h2>';
});

Route::get('/guru', function () {
    return view('guru');
});

Route::get('/siswa', function () {
    return view('siswa');
});

Route::get('/blogs', function () {
    return view('blogs');
});
Route::resource('/blog', \App\Http\Controllers\BlogController::class);

// Route::get('/beranda', function () {
//     return view('beranda');
// });
Route::get('/tampil', [BlogController::class, 'search']);

