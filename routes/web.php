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
Route::get('/usermaster/adduser', [GenxController::class, 'adduser']);
Route::post('/usermaster/adduser', [GenxController::class, 'saveadduser']);
Route::get('/usermaster/changeactive/{id}',[GenxController::class,'changeactive'])->name('usermaster.changeactive');
Route::get('/usermaster/edituser/{id}',[GenxController::class,'edituser'])->name('usermaster.edituser');
Route::post('/usermaster/edituser/{id}',[GenxController::class,'saveedituser'])->name('usermaster.saveedituser');
Route::get('/usermaster/deleteuser/{id}',[GenxController::class,'deleteuser'])->name('usermaster.deleteuser');
Route::post('/usermaster/deleteuser/{id}',[GenxController::class,'confirmdeleteuser'])->name('usermaster.confirmdeleteuser');
Route::get('/usermaster/sendpassword/{id}',[GenxController::class,'sendpassword'])->name('usermaster.sendpassword');

Route::get('/customers', CustomerMaster::class)->name('customer.master');
Route::get('/customers/adduser', CustomerAdduser::class)->name('customer.master.adduser');
