<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SearchController;

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

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/search/{query}', [SearchController::class, 'filter'])->name('search')->middleware('auth:api');

if (config("app.env") == "local") {
  Route::get('/test/view/{page}', function ($page) {
    return view($page);
  });
}
