<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  return view('welcome');
});

Route::middleware("auth")->group(function(){
  Route::get('/home', [HomeController::class, 'index'])->name('home');

  Route::group(["prefix"=>"user", "as"=>"admin.user."], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/search/{query}', [UserController::class, 'filter'])->name('search');
    Route::get('/{username}', [UserController::class, 'detail'])->name('detail');
  });
});


if (config("app.env") == "local") {
  Route::get('/test/view/{page}', function ($page) {
    return view($page);
  });
}
