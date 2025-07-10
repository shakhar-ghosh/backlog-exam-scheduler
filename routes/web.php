<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', [HomeController::class,'home']);
Route::get('/register/{id}',[HomeController::class, 'register']);
Route::post('/register', [HomeController::class, 'registerstudent']);
Route::get('/login',function (){
    return view('login');
});
Route::post('/login', [HomeController::class, 'login']);
Route::post('/course', [AdminController::class, 'courseupdate'])->middleware('adminlogin');
Route::get('/courses/{courseid}/{examid}',[AdminController::class, 'course'])->middleware('adminlogin');
Route::get('/schedule/{id}',[AdminController::class, 'schedule'])->middleware('adminlogin');
Route::get('/students/{id}',[AdminController::class, 'students'])->middleware('adminlogin');
Route::post('/students',[AdminController::class, 'studentsupdate'])->middleware('adminlogin');
Route::post('/exams',[HomeController::class, 'addorupdateexams'])->middleware('adminlogin');
Route::get('/exams/{id}',[HomeController::class, 'exams'])->middleware('adminlogin');
Route::get('/admin',[HomeController::class, 'admin'])->middleware('adminlogin');
Route::get('/logout', [HomeController::class, 'logout']);
Route::get('/download/{examid}/{roll}',[HomeController::class, 'download']);
Route::post('/exams',[HomeController::class, 'addorupdateexams'])->middleware('adminlogin');
Route::get('/update-student/{id}', [AdminController::class, 'updateStudent'])->middleware('adminlogin');
Route::post('/update-student', [AdminController::class, 'updateStudentPost'])->middleware('adminlogin');

