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

Route::get('/admin', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')
->prefix('admin') //per il /admin/home
->name('admin.')   //per il nome admin.home
->namespace('Admin')  //toglie Admin\
->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('posts','PostController');
    Route::resource('tags','TagController')->only('show');
});



// UNA ROTTA CHE PRENDE TUTTE LE ROTTE NON REGISTRATE, va per forza alla fine
// any è una qualcuasi parola, il ? serve per dire che può essere anche assente
//il where  va a inserire ogni tipo di combinazione da 0 a più volte
Route::get('{any?}',function(){
    return view('guest.home');
})->where('any','.*');
