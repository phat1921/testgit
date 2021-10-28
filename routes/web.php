<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\CheckLogged;
use App\Http\Controllers\StatisController;
use App\Http\Middleware\ProfileController;
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
Route::get('/login', [AuthenticateController::class, 'login'])->name('login');
Route::post('/login-process',[AuthenticateController::class, 'loginProcess'])->name('login-process');




Route::middleware([CheckLogin::class])->group(function(){

    Route::resource("course", CourseController::class);
    Route::resource("classroom", ClassroomController::class );
    Route::resource("subject", SubjectController::class );
    
    Route::resource("admin", AdminController::class );
    Route::get('/',[StatisController::class, 'statis'])->name('dashboard');
    Route::get('/logout',[AuthenticateController::class, 'logout'])->name('logout');
     Route::post('/export-excel-process', [StatisController::class, 'exportExcelProcess'])->name('export-excel-process');
     Route::post('/export-excel-process2', [StatisController::class, 'exportExcelProcess2'])->name('export-excel-process2');
});


Route::middleware([CheckLogged::class])->group(function(){
    Route::get('/login', [AuthenticateController::class, 'login'])->name('login');
    Route::post('/login-process',[AuthenticateController::class, 'loginProcess'])->name('login-process');
});

Route::prefix("student")->name('student.')->group(function(){
    Route::get('/hide/{id}',[StudentController::class, 'hide'])->name('hide');
    Route::get('/insert-excel', [StudentController::class, 'insertExcel'])->name('insert-excel');
    Route::post('/insert-excel-process', [StudentController::class, 'insertExcelProcess'])->name('insert-excel-process');

   
});

Route::resource("student", StudentController::class );

Route::prefix("classroom")->name('classroom.')->group(function(){
    Route::get('/hide/{id}', [ClassroomController::class, 'hide'])->name('hide');
});

Route::prefix("course")->name('course.')->group(function(){
    Route::get('/hide/{id}', [CourseController::class, 'hide'])->name('hide');
});

Route::prefix("subject")->name('subject.')->group(function(){
    Route::get('/hide/{id}', [SubjectController::class, 'hide'])->name('hide');
    
});


Route::prefix("book")->name('book.')->group(function(){
    Route::get('/hide/{id}',[BookController::class, 'hide'])->name('hide');

    Route::get('/insert-amount', [BookController::class, 'insertAmount'])->name('insert-amount');
    Route::get('/insert-amount2',[BookController::class, 'show'])->name('insert-amount2');
    Route::post('/insert-amount-process/{id}', [BookController::class, 'insertAmountProcess'])->name('insert-amount-process');

    Route::get('/create-bill', [BookController::class, 'createBill'])->name('create-bill');
    Route::post('/create-bill-process', [BookController::class, 'createBillProcess'])->name('create-bill-process');
    Route::get('/update-bill/{id}',[BookController::class, 'updateBill'])->name('update-bill');

    Route::get('/main-bill', [BookController::class, 'mainBill'])->name('main-bill');
    Route::get('/delete-main-bill/{id}', [BookController::class, 'deleteMainBill'])->name('delete-main-bill');

    Route::get('/handing-out/{id}', [BookController::class, 'handingOut'])->name('handing-out');
    Route::post('/handing-out-process/{id}', [BookController::class, 'handingOutProcess'])->name('handing-out-process');
});
Route::resource("book", BookController::class );



Route::prefix("admin")->name('admin.')->group(function(){
    Route::get('/hide/{id}',[AdminController::class, 'hide'])->name('hide');
    Route::get('/show', [AdminController::class, 'show'])->name('show');
});


// Route::get('course', function(){
//     return view('Course.index');
// })->name('course');