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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/task/test', function(){
    $task = new \App\Jobs\TestTask('test');
    $success = \Hhxsv5\LaravelS\Swoole\Task\Task::deliver($task);
    var_dump($success);
});
