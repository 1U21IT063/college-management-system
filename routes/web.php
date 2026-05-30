<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'index']);

//student routes

Route::get('/students/create', [StudentController::class, 'create']);
Route::post('/students/store', [StudentController::class, 'store']);
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/edit/{id}', [StudentController::class, 'edit']);
Route::post('/students/update/{id}', [StudentController::class, 'update']);
Route::get('/students/delete/{id}', [StudentController::class, 'delete']);
Route::get('/students/show/{id}', [StudentController::class, 'show']);

//staff routes

Route::get('/staff', [StaffController::class, 'index']);
Route::get('/staff/create', [StaffController::class, 'create']);
Route::post('/staff/store', [StaffController::class, 'store']);
Route::get('/staff/edit/{id}', [StaffController::class, 'edit']);
Route::post('/staff/update/{id}', [StaffController::class, 'update']);
Route::get('/staff/delete/{id}', [StaffController::class, 'delete']);

//course routes

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/create', [CourseController::class, 'create']);
Route::post('/courses/store', [CourseController::class, 'store']);
Route::get('/courses/edit/{id}', [CourseController::class, 'edit']);
Route::post('/courses/update/{id}', [CourseController::class, 'update']);
Route::get('/courses/delete/{id}', [CourseController::class, 'delete']);

//department routes

Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/departments/create', [DepartmentController::class, 'create']);
Route::post('/departments/store', [DepartmentController::class, 'store']);
Route::get('/departments/edit/{id}', [DepartmentController::class, 'edit']);
Route::post('/departments/update/{id}', [DepartmentController::class, 'update']);
Route::get('/departments/delete/{id}', [DepartmentController::class, 'delete']);

//attendance routes

Route::get('/attendance', [AttendanceController::class, 'index']);
Route::post('/attendance/store', [AttendanceController::class, 'store']);

//fee routes

Route::get('/fees', [FeeController::class, 'index']);
Route::get('/fees/create', [FeeController::class, 'create']);
Route::post('/fees/store', [FeeController::class, 'store']);
Route::get('/fees/edit/{id}', [FeeController::class, 'edit']);
Route::post('/fees/update/{id}', [FeeController::class, 'update']);
Route::get('/fees/delete/{id}', [FeeController::class, 'delete']);

//mark routes

Route::get('/marks', [MarkController::class, 'index']);
Route::get('/marks/create', [MarkController::class, 'create']);
Route::post('/marks/store', [MarkController::class, 'store']);
Route::get('/marks/edit/{id}', [MarkController::class, 'edit']);
Route::post('/marks/update/{id}', [MarkController::class, 'update']);
Route::get('/marks/delete/{id}', [MarkController::class, 'delete']);Route::get('/marks', [MarkController::class, 'index']);
Route::get('/marks/create', [MarkController::class, 'create']);
Route::post('/marks/store', [MarkController::class, 'store']);
Route::get('/marks/edit/{id}', [MarkController::class, 'edit']);
Route::post('/marks/update/{id}', [MarkController::class, 'update']);
Route::get('/marks/delete/{id}', [MarkController::class, 'delete']);

//pdf routes

Route::get('/students/pdf', [StudentController::class, 'pdf']);
Route::get('/fees/pdf', [FeeController::class, 'pdf']);
Route::get('/marks/pdf', [MarkController::class, 'pdf']);
    
//report routes

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);