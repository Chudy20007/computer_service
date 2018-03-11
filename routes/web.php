<?php

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
Route::post('/store_order','OrderController@store');
Route::middleware(['admin'])->group(function () {
    Route::get('/a',function() {
        return "this page requires that you be logged in and an Admin";
    });
    Route::get('/b',function() {
        return "this page BBB requires that you be logged in and an Admin";
    });
    });

Route::get('s', ['middleware' => ['auth', 'supervisor'], function() {
    return "this page requires that you be logged in and an Supervisor";
}]);

Route::get('e', ['middleware' => ['auth', 'employee'], function() {
    return "this page requires that you be logged in and an Employee";
}]);

Route::get('/', function () {
    return view('main');
});

Route::get('/add_order',function() {
    return view('order.add_order');
});

Route::get('/contact', function () {
    return view('static_views.contact');
});
Route::get('/about', function () {
    return view('static_views.about');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::auth();
Auth::routes();