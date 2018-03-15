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
Route::post('/store_order','OrderController@storeOrder');
Route::middleware('permissions')->group(function () {
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::get('create_task/{id?}','TaskController@showTaskForm');
    Route::post('create_task','TaskController@storeTask');
    Route::get('create_service','ServiceController@showServiceForm');
    Route::post('create_service','ServiceController@storeService');
    Route::get('create_category','CategoryController@showCategoryForm');
    Route::post('create_category','CategoryController@storeCategory');
    Route::get('show_employees','EmployeeControler@showEmployeesList');
    Route::get('add_services_to_order/{id?}','OrderController@showServicesOrderForm');
    Route::post('store_order_services','OrderController@storeOrderServices'); 
    Route::get('add_part','PartController@showPartForm');
    Route::post('store_part','PartController@storePart');   
    Route::get('edit_category/{id}','CategoryController@showCategoryEditForm');
    Route::post('edit_category','CategoryController@editCategory');
    });

    Route::get('/b',function() {
        return "this page BBB requires that you be logged in and an Admin";
    });


    Route::get('add_services_to_order/{id?}','OrderController@showServicesOrderForm')->middleware('auth');
    Route::get('add_parts_to_order/{id?}','OrderController@showPartsOrderForm')->middleware('auth');
    Route::post('add_parts_to_order/{id?}','OrderController@storeOrderParts')->middleware('auth');
    Route::get('show_orders','OrderController@showOrdersList')->middleware('auth');
    Route::get('order/{id}','OrderController@showOrder')->middleware('auth');
    Route::get('user/{id}','OrderController@showUserOrdersList')->middleware('auth');
    Route::get('edit_order/{id}','OrderController@showOrderEditForm')->middleware('auth');
    Route::post('edit_order','OrderController@editOrder')->middleware('auth');
    Route::get('show_parts','PartController@showPartsList')->middleware('auth');
    Route::get('show_services','ServiceController@showServicesList')->middleware('auth');
    Route::get('show_categories','CategoryController@showCategoriesList')->middleware('auth');
    Route::get('show_tasks','TaskController@showTasksList')->middleware('auth');
    Route::get('edit_order_objects/{id}','OrderController@showOrderObjectsEditForm')->middleware('auth');
    Route::post('edit_order_objects','OrderController@editOrderObjects')->middleware('auth');
    Route::get('show_order_objects/{id}','OrderController@showOrderObjectsList')->middleware('auth');
    
    Route::get('show_task_details/{id?}','TaskController@showTaskDetails');
    Route::post('get_messages','TaskController@refreshTaskMessages');
    Route::post('show_task_details/{id?}','TaskController@storeTaskMessage');
Route::get('/', function () {
    return view('main');
});

Route::get('/add_order',function() {
    return view('orders.add_order');
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