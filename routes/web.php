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
Route::post('/login','App\Http\Controllers\LoginController@login');
Route::post('/register','App\Http\Controllers\LoginController@register');
Route::post('/logout','App\Http\Controllers\LoginController@logout');
Route::post('/countCalories','App\Http\Controllers\MainController@countCalories');
Route::post('/countWater','App\Http\Controllers\WaterController@countWater');
Route::post('/drink_email/{variable}','App\Http\Controllers\WaterController@drink_email');
Route::post('/newprodadd','App\Http\Controllers\MainController@newprodadd');
Route::get('/bad_password','App\Http\Controllers\MainController@bad_password');




