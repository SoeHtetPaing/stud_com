<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LecturerController;

Route::get('/', function () {
    return view('auth.login');

});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [UserController::class,'home'])->name('user@home');
});

Route::get('/user/chat', [UserController::class,'chat'])->name('user@chat');


Route::get('/student/setting', [StudentController::class,'setting'])->name('student@setting');
Route::get('/teacher/setting', [LecturerController::class,'setting'])->name('lecturer@setting');
Route::get('/admin/setting', [AdminController::class,'setting'])->name('admin@setting');

Route::post('/admin/addAnnouncement', [AdminController::class, 'addAnnouncement'])->name('admin@addAnnouncement');
Route::post('/admin/addAdmin', [AdminController::class, 'addAdmin'])->name('admin@addAdmin');
Route::post('/admin/addLecturer', [AdminController::class, 'addLecturer'])->name('admin@addLecturer');
Route::post('/admin/addStudent', [AdminController::class, 'addStudent'])->name('admin@addStudent');
Route::post('/admin/addTimetable', [AdminController::class, 'addTimetable'])->name('admin@addTimetable');
Route::post('/admin/addDepartment', [AdminController::class, 'addDepartment'])->name('admin@addDepartment');

