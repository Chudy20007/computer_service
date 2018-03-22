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
Route::post('/store_order', 'OrderController@storeOrder');
Route::middleware('permissions')->group(function () {
    Route::post('register', '\App\Http\Controllers\Auth\RegisterController@register');
    Route::get('register', '\App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::get('create_task/{id?}', 'TaskController@showTaskForm');
    Route::post('create_task', 'TaskController@storeTask');
    Route::get('create_service', 'ServiceController@showServiceForm');
    Route::post('create_service', 'ServiceController@storeService');
    Route::get('create_category', 'CategoryController@showCategoryForm');
    Route::post('create_category', 'CategoryController@storeCategory');
    Route::get('show_employees', 'EmployeeController@showEmployeesList');
    Route::get('add_services_to_order/{id?}', 'OrderController@showServicesOrderForm');

    Route::get('add_part', 'PartController@showPartForm');
    Route::post('store_part', 'PartController@storePart');
    Route::get('edit_category/{id}', 'CategoryController@showCategoryEditForm');
    Route::patch('edit_category', 'CategoryController@editCategory');
    Route::get('edit_service/{id}', 'ServiceController@showServiceEditForm');
    Route::patch('edit_service', 'ServiceController@editService');
    Route::get('edit_employee/{id}', 'EmployeeController@showEmployeeEditForm');
    Route::patch('edit_employee', 'EmployeeController@editEmployee');
    Route::delete('deactivate_order}', 'AdminController@deactivateOrder');
    Route::patch('activate_order}', 'AdminController@activateOrder');
    Route::delete('deactivate_part', 'AdminController@deactivatePart');
    Route::patch('activate_part', 'AdminController@activatePart');
    Route::delete('deactivate_category}', 'AdminController@deactivateCategory');
    Route::patch('activate_category}', 'AdminController@activateCategory');
    Route::delete('deactivate_task', 'AdminController@deactivateTask');
    Route::patch('activate_task', 'AdminController@activateTask');
    Route::delete('deactivate_service}', 'AdminController@deactivateService');
    Route::patch('activate_service}', 'AdminController@activateService');
    Route::delete('deactivate_employee', 'AdminController@deactivateEmployee');
    Route::patch('activate_employee', 'AdminController@activateEmployee');
});

Route::get('generated_invoice', 'InvoiceController@generateInvoice');
Route::post('generated_invoice_to_pdf', 'InvoiceController@generateInvoiceToPDF');

Route::get('/b', function () {
    return "this page BBB requires that you be logged in and an Admin";
});
Route::get('sendbasicemail', 'OrderController@sendMessage');
Route::post('store_order_services', 'OrderController@storeOrderServices')->middleware('auth');
Route::get('create_invoice/{id}', 'InvoiceController@showInvoiceForm')->middleware('auth');
Route::post('store_invoice', 'InvoiceController@storeInvoice')->middleware('auth');
Route::get('show_invoices', 'InvoiceController@showInvoicesList')->middleware('auth');
Route::delete('deactivate_invoice', 'AdminController@deactivateInvoice');
Route::patch('activate_invoice', 'AdminController@activateInvoice');
Route::post('send_invoices', 'InvoiceController@saveHTMLInvoicesInServer');
Route::post('generate_invoice', 'InvoiceController@generateInvoice');
Route::get('send_html_invoice/{invoice_id}', 'InvoiceController@showHTMLInvoiceForm')->middleware('auth');;
Route::delete('deactivate_service_order}', 'AdminController@deactivateOrderService')->middleware('auth');;
Route::patch('activate_service_order}', 'AdminController@activateOrderService')->middleware('auth');;
Route::delete('deactivate_order_part', 'AdminController@deactivateOrderPart')->middleware('auth');;
Route::patch('activate_order_part', 'AdminController@activateOrderPart')->middleware('auth');;
Route::delete('deactivate_order_object}', 'AdminController@deactivateOrderObject')->middleware('auth');;
Route::patch('activate_order_object}', 'AdminController@activateOrderObject')->middleware('auth');;

Route::delete('deactivate_service}', 'AdminController@deactivateService')->middleware('auth');;
Route::patch('activate_service}', 'AdminController@activateService')->middleware('auth');;
Route::delete('deactivate_employee', 'AdminController@deactivateEmployee')->middleware('auth');;
Route::patch('activate_employee', 'AdminController@activateEmployee')->middleware('auth');;

Route::post('send_message/{id}', 'OrderController@showMessageForm')->middleware('auth');
Route::post('send_message', 'OrderController@sendMessage')->middleware('auth');
Route::get('add_services_to_order/{id?}', 'OrderController@showServicesOrderForm')->middleware('auth');
Route::get('add_parts_to_order/{id?}', 'OrderController@showPartsOrderForm')->middleware('auth');
Route::post('add_parts_to_order/{id?}', 'OrderController@storeOrderParts')->middleware('auth');
Route::get('show_orders', 'OrderController@showOrdersList')->middleware('auth');
Route::get('order/{id}', 'OrderController@showOrder')->middleware('auth');
Route::get('user/{id}', 'OrderController@showUserOrdersList')->middleware('auth');
Route::get('edit_order/{id}', 'OrderController@showOrderEditForm')->middleware('auth');
Route::post('edit_order', 'OrderController@editOrder')->middleware('auth');
Route::get('show_employees', 'EmployeeController@showEmployeesList')->middleware('auth');
Route::get('show_parts', 'PartController@showPartsList')->middleware('auth');
Route::get('show_services', 'ServiceController@showServicesList')->middleware('auth');
Route::get('show_categories', 'CategoryController@showCategoriesList')->middleware('auth');
Route::get('show_tasks', 'TaskController@showTasksList')->middleware('auth');
Route::get('edit_task/{id}', 'TaskController@showTaskEditForm')->middleware('auth');
Route::patch('edit_task', 'TaskController@editTask')->middleware('auth');
Route::get('edit_order_objects/{id}', 'OrderController@showOrderObjectsEditForm')->middleware('auth');
Route::post('edit_order_objects', 'OrderController@editOrderObjects')->middleware('auth');
Route::get('show_order_objects/{id}', 'OrderController@showOrderObjectsList')->middleware('auth');
Route::get('show_order_parts/{id}', 'OrderController@showOrderPartsList')->middleware('auth');
Route::get('show_order_services/{id}', 'OrderController@showOrderServicesList')->middleware('auth');
Route::get('edit_part/{id}', 'PartController@showPartEditForm')->middleware('auth');
Route::patch('edit_part', 'PartController@editPart')->middleware('auth');
Route::get('show_task_details/{id?}', 'TaskController@showTaskDetails');
Route::post('get_messages', 'TaskController@refreshTaskMessages');
Route::post('show_task_details/{id?}', 'TaskController@storeTaskMessage');
Route::get('/', function () {
    return view('main');
});

Route::get('/add_order', function () {
    return view('orders.add_order');
});

Route::get('/contact', function () {
    return view('static_views.contact');
});
Route::get('/about', function () {
    return view('static_views.about');
});

Route::get('/access_denied,', function () {
    return view('users.access_denied');
});
Route::post('password/email', '\App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', '\App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');
Route::get('/services', function () {
    return view('services.show');
});

