<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {        // ログインしている状態でないと以下ルーティングはできない
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // ユーザー関連  //make:Controller --resource で作成したコントローラのCRUD処理へ一括でルーティング
    // Route::resource('/users', UsersController::class);
    Route::resource('/users', UsersController::class, ['only' => ['index', 'show', 'edit', 'update']]); //only内のメソッドのみを使う
    // フォロー/フォロー解除を追加
    Route::post('/users/{user}/follow', [UsersController::class, 'follow'])->name('follow');
    Route::delete('/users/{user}/unfollow', [UsersController::class, 'unfollow'])->name('unfollow');
    //ユーザー詳細画面遷移
    Route::post('/users/{id}/', [UsersController::class, 'show'])->name('show');

    //ツイート関連
    Route::resource('tweets', TweetsController::class, ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
});