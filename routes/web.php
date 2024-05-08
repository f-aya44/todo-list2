<?php

use App\Http\Controllers\HelloWorldController;
use App\Http\Controllers\SampleController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoListController;
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

// Route::view('/hello','hello-world')->name('hello.world');
//コントローラーが呼び出されるように記述変更
Route::resource('todos', TodoController::class);

Route::get('todo',[TodoListController::class,'index']);

Route::get('todo_search',[TodoListController::class,'search']);
