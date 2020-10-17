<?php

use App\Http\Controllers\API\StakeController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');

Route::post('login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
  Route::group(['prefix' => 'user', 'as' => 'user.'], static function () {
    Route::get('/index', [UserController::class, 'index'])->name('index');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
  });

  Route::group(['prefix' => 'stake', 'as' => 'stake.'], static function () {
    Route::get('/index', [StakeController::class, 'index'])->name('index');
  });
});