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

Route::get('/','App\Http\Controllers\MainController@index');
Route::post('/login','App\Http\Controllers\MainController@login');
Route::post('/register','App\Http\Controllers\MainController@register');
Route::post('/logout','App\Http\Controllers\MainController@logout');
Route::post('/countCalories','App\Http\Controllers\MainController@countCalories');
Route::post('/countWater','App\Http\Controllers\MainController@countWater');


