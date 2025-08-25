<?php
use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;

use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

//新規登録画面
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
//Route::post('/register', [AuthController::class, 'register'])->name('register');

//ログイン画面
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');


//認証後のアクセス
Route::middleware('auth')->group(function (){
Route::get('/admin', [AuthController::class, 'admin'])->name('admin');
Route::get('admin/search',[AuthController::class, 'search'])->name('search');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::delete('/admin/delete',[AuthController::class, 'destroy'])->name('destroy');
});

//お問い合わせフォーム
Route::get('/', [ContactController::class, 'index'])->name('index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/store',[ContactController::class, 'store'])->name('store');
Route::get('/thanks', [ContactController::class, 'showThankYou'])->name('thanks');


