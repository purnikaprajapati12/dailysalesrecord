<?php


use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\frontend\LogInController;
use App\Http\Controllers\frontend\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\ChartController;
use App\Http\Controllers\frontend\ItemController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\SettingsController;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;

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



Route::get('/', [UserController::class, 'loginForm']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
//employee-Dashboard
Route::get('/employee-index', [IndexController::class, 'employeeIndex']);
//admin-Dashboard

//employee
Route::get('/admin-index', [IndexController::class, 'adminIndex']);
Route::get('/manage-employee', [UserController::class, 'manage_employee']);
Route::get('/create-employee', [UserController::class, 'create_employee']);
Route::post('/create-employee', [UserController::class, 'store']);
Route::get('/delete-employee/{user_id}', [UserController::class, 'delete'])->name('employee.delete');
Route::get('/edit-employee/{user_id}', [UserController::class, 'edit'])->name('employee.edit');
Route::post('/update-employee/{user_id}', [UserController::class, 'update'])->name('employee.update');

//Category
Route::get('/manage-category', [CategoryController::class, 'category']);
Route::get('/create-category', [CategoryController::class, 'create_category']);
Route::post('/create-category', [CategoryController::class, 'store']);
Route::get('/delete-category/{category_id}', [CategoryController::class, 'delete'])->name('category.delete');
Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/update-category/{category_id}', [CategoryController::class, 'update'])->name('category.update');
//charts
Route::get('/charts', [ChartController::class, 'charts']);

// //settings
// Route::get('/settings', [SettingsController::class, 'settings']);

//order
Route::get('/manage-sales', [OrderController::class, 'orders']);
Route::get('/create-sales', [OrderController::class, 'create_orders']);
Route::post('/create-sales', [OrderController::class, 'store']);
Route::get('/view-sale/{id}', [OrderController::class, 'view']);
Route::get('/delete-sale/{id}', [OrderController::class, 'delete'])->name('sale.delete');
Route::get('/report', [OrderController::class, 'daily_sales_report']);



//item
Route::get('/manage-item', [ItemController::class, 'item']);
Route::get('/create-item', [ItemController::class, 'create_item']);
// Route::get('/manage-item/{category_id}',[ItemController::class,'search']);
// Route::get('/search-item',[ItemController::class,'search-item']);
Route::post('/create-item', [ItemController::class, 'store']);
Route::get('/delete-item/{item_id}', [ItemController::class, 'delete'])->name('item.delete');
Route::get('/edit-item/{item_id}', [ItemController::class, 'edit'])->name('item.edit');
Route::post('/update-item/{item_id}', [ItemController::class, 'update'])->name('item.update');

//print
// routes/web.php

// use App\Http\Controllers\PrintController;

Route::get('/print/{id}', [PrintController::class, 'printInvoice'])->name('print.invoice');
Route::get('/reportprint', [PrintController::class, 'showReport'])->name('report.show');
