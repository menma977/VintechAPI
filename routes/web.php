<?php

use Illuminate\Log\Logger;
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


if(config("app.env") == "local") {
    Route::get('/test/view/{page}', function ($page) {
        return view($page);
    });
}
