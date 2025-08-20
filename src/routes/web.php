<?php

use Illuminate\Support\Facades\Route;

//コントローラーファイルのインポート
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;

//バリデーションのインポート
use App\Http\Requests\ContactRequest;
use App\Http\Requests\UserRequest;

//ミドルウェアのインポート
use App\Http\Middleware\ContactMiddleware;

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

Route::get('/', [ContactController::class, 'index'])->name('index');
Route::get('/thanks', [ContactController::class, 'showThankYou'])->name('thanks');




