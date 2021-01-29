<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/', 'HomeController@index')->name('home');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//　打ち身詳細画面を表示
Route::get('/showDetail/{id}', [App\Http\Controllers\BruiseController::class, 'showDetail'])->name('showDetail');

//　打ち身一覧画面を表示
Route::get('/showList', [App\Http\Controllers\BruiseController::class, 'showList'])->name('showList');
//Route::get('/', [App\Http\Controllers\BruiseController::class, 'showList'])->name('showList');

//　打ち身登録画面を表示
Route::get('/showCreate', [App\Http\Controllers\BruiseController::class, 'showCreate'])->name('create');

//　打ち身登録
Route::post('/insert', [App\Http\Controllers\BruiseController::class, 'exeInsert'])->name('insert');

//　打ち身編集画面を表示
Route::get('/showEdit/{id}', [App\Http\Controllers\BruiseController::class, 'showEdit'])->name('showEdit');
//　打ち身編集画面のIDを決定してリダイレクト
Route::get('/showEditId', [App\Http\Controllers\BruiseController::class, 'showEditId'])->name('showEditId');

//　打ち身登録
Route::post('/update', [App\Http\Controllers\BruiseController::class, 'exeUpdate'])->name('update');

//　詳細画面からの更新してファイルアップロード
Route::post('/upload', [App\Http\Controllers\BruiseController::class, 'exeUpload'])->name('upload');

//　いきなり登録してファイルアップロード
Route::get('/showUpload', [App\Http\Controllers\BruiseController::class, 'showUpload'])->name('showUpload');
Route::get('/', [App\Http\Controllers\BruiseController::class, 'showUpload'])->name('showUpload');

//　ファイルアップロード
Route::post('/insUpload', [App\Http\Controllers\BruiseController::class, 'insUpload'])->name('insUpload');

//　pdf作成
Route::get('/mkPdf/{id}', [App\Http\Controllers\BruiseController::class, 'mkPdf'])->name('mkPdf');
