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
Route::middleware('permissions')->group(function () {
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::get('create_task','TaskController@showTaskForm');
    Route::post('create_task','TaskController@storeTask');
    Route::get('create_service','ServiceController@showServiceForm');
    Route::post('create_service','ServiceController@storeService');
    Route::get('create_category','CategoryController@showCategoryForm');
    Route::post('create_category','CategoryController@storeCategory');
       
    });
    Route::get('/b',function() {
        return "this page BBB requires that you be logged in and an Admin";
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

Route::get('/access_denied,',function(){
return view ('users.access_denied');
});
Route::post('password/email','App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset','App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');
Route::get('/services',function()
{
return view('services.show');
});