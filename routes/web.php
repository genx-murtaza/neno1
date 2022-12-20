<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenxController;
use App\Http\Livewire\Customer;
use App\Http\Livewire\CustomerMaster;
use App\Http\Livewire\CustomerAdduser;

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

Route::get('/', [GenxController::class, 'authentication']);
Route::post('/', [GenxController::class, 'check_authentication']);
Route::get('/dashboard', [GenxController::class, 'dashboard']);
Route::get('/logout', [GenxController::class, 'logout']);

Route::get('/usermaster', [GenxController::class, 'usermaster']);
Route::get('/usermaster/add', [GenxController::class, 'adduser']);
Route::post('/usermaster/add', [GenxController::class, 'saveadduser']);
Route::get('/usermaster/changeactive/{id}',[GenxController::class,'changeactive'])->name('usermaster.changeactive');
Route::get('/usermaster/edit/{id}',[GenxController::class,'edituser'])->name('usermaster.edit');
Route::post('/usermaster/edit/{id}',[GenxController::class,'saveedituser'])->name('usermaster.saveedituser');
Route::get('/usermaster/delete/{id}',[GenxController::class,'deleteuser'])->name('usermaster.delete');
Route::post('/usermaster/delete/{id}',[GenxController::class,'confirmdeleteuser'])->name('usermaster.confirmdeleteuser');
Route::get('/usermaster/sendpassword/{id}',[GenxController::class,'sendpassword'])->name('usermaster.sendpassword');

Route::get('/customers', [GenxController::class, 'customermaster']);
Route::get('/customers/add', [GenxController::class, 'addcustomer']);
Route::post('/customers/add', [GenxController::class, 'saveaddcustomer']);
Route::get('/customers/edit/{id}',[GenxController::class,'editcustomer'])->name('customers.edit');
Route::post('/customers/edit/{id}',[GenxController::class,'saveeditcustomer'])->name('customers.saveedit');
Route::get('/customers/delete/{id}',[GenxController::class,'deletecustomer'])->name('customers.delete');
Route::post('/customers/delete/{id}',[GenxController::class,'confirmdeletecustomer'])->name('customers.confirmdeletecustomer');

Route::get('/payments', [GenxController::class, 'payments']);
Route::post('/payments', [GenxController::class, 'showpayments']);
Route::get('/payments/add', [GenxController::class, 'addpayments']);
Route::post('/payments/add', [GenxController::class, 'savenewpayments']);

Route::get('/visits', [GenxController::class, 'visits']);
Route::post('/visits', [GenxController::class, 'showvisits']);
Route::get('/visits/add', [GenxController::class, 'addvisits']);
Route::post('/visits/add', [GenxController::class, 'savenewvisits']);


// Route::get('/customers', CustomerMaster::class);
// Route::get('/customers/adduser', CustomerAdduser::class);
