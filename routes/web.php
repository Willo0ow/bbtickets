<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TlogController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

///Api
Route::resource('/api/category', CategoryController::class);
Route::get('/api/departmentcategories/{department}', [CategoryController::class, 'retrieveDepartmentCategories']);
Route::resource('/api/department', DepartmentController::class);
Route::resource('/api/message', MessageController::class);
Route::get('/api/ticketmessages/{ticket}', [MessageController::class, 'retrieveByTicket']);
Route::get('/api/recepientmessages/{recepient}', [MessageController::class, 'retrieveByRecipent']);
Route::resource('/api/status', StatusController::class);
Route::get('/api/typestatuses/{type}', [StatusController::class, 'retrieveByType']);
Route::resource('/api/ticket', TicketController::class);
Route::get('/api/statustickets/{status}', [TicketController::class, 'retrieveByStatus']);
Route::get('/api/ticketlogs', [TlogController::class, 'retrieveTicketLogs']);
////

Route::get('/{any}',function (){
    return view('home');})->where('any', '.*')->middleware('auth');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
