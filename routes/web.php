<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
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

Route::middleware("auth")->group(function () {
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::get('/online', [HomeController::class, 'online'])->name('online');

  Route::group(["prefix" => "user", "as" => "admin.user."], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/search/{query?}', [UserController::class, 'filter'])->name('search');
    Route::get('/details/{username}', [UserController::class, 'detail'])->name('detail');
  });

  Route::group(["prefix" => "setting", "as" => "setting."], function () {
    Route::get('/version', [SettingController::class, 'version'])->name('version');
    Route::post('/updateVersion', [SettingController::class, 'updateVersion'])->name('update_version');
  });
});


if (config("app.env") == "local") {
  Route::get('/test/view/{page}', function ($page) {
    return view($page);
  });
}
