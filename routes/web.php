<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CustomerController;




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
     return view('auth.login');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
    });

    Route::group(['middleware' => 'auth'], function () {

 Route::resource('/shops',ShopController::class);
 Route::resource('/customers',CustomerController::class);
    });


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


