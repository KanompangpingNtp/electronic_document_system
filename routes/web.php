<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ShowinformationController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//login-register
Route::get('showRegisterForm', [AuthController::class, 'showRegisterForm'])->name('showRegisterForm');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::get('showLoginForm', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//ผู้ใช้
Route::get('/', [FormController::class, 'userForms'])->name('userForms');
Route::post('/formsCreate', [FormController::class, 'formsCreate'])->name('formsCreate');


// แอดมิน
// Route::get('/admin/showinformationIndex', [ShowinformationController::class, 'showinformationIndex'])->name('showinformationIndex');
// Route::get('/admin/show-information/edit/{id}', [ShowinformationController::class, 'showinformationEdit'])->name('showinformationEdit');
// Route::post('/admin/form/update/{id}', [FormController::class, 'formsEdit'])->name('admin.form.update');
// Route::post('/forms/{form}/reply', [FormController::class, 'reply'])->name('forms.reply');
// Route::get('/forms/export/{id}', [ShowinformationController::class, 'exportPDF'])->name('exportPDF');
// Route::post('/forms/{id}/update-status', [FormController::class, 'updateStatus'])->name('updateStatus');
// Route::get('/userAccount', [FormController::class, 'userAccount'])->name('userAccount');

// Route Group สำหรับ Admin
Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/admin/showinformationIndex', [ShowinformationController::class, 'showinformationIndex'])->name('showinformationIndex');
    Route::get('/admin/show-information/edit/{id}', [ShowinformationController::class, 'showinformationEdit'])->name('showinformationEdit');
    Route::post('/admin/form/update/{id}', [FormController::class, 'formsEdit'])->name('admin.form.update');
    Route::get('/forms/export/{id}', [ShowinformationController::class, 'exportPDF'])->name('exportPDF');
    Route::post('/forms/{id}/update-status', [FormController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/forms/{form}/reply', [FormController::class, 'reply'])->name('forms.reply');
});

// Route Group สำหรับ User
Route::group(['middleware' => 'role:user'], function () {
    Route::get('/userAccount', [FormController::class, 'userAccount'])->name('userAccount');
    Route::get('/user/forms', [ShowinformationController::class, 'showinformationUser'])->name('showinformationUser');
});
