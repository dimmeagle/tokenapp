<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\RecordsController as FrontendRC;
use App\Http\Controllers\Backend\RecordsController as BackendRC;

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

Route::resource('data', FrontendRC::class)->only(['index', 'create','store']);
Route::resource('records', BackendRC::class)->except('create');
