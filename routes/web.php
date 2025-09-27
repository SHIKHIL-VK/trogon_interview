<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginAction'])->name('login.action');
Route::get('logout',[UserController::class, 'logout'])->name('logout');
// Route::get('/user', [UserController::class, 'index']);
Route::middleware(['auth'])->prefix('courses')->name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('create',[CourseController::class,'create'])->name('create');
    Route::post('create',[CourseController::class,'store'])->name('store');
    Route::get('edit/{id}',[CourseController::class,'edit'])->name('edit');
    Route::put('edit/{id}',[CourseController::class,'update'])->name('update');
    Route::get('enroll/{id}',[CourseController::class,'enroll'])->name('enroll');
    Route::get('my-course',[CourseController::class,'myCourse'])->name('mycourse');
});
