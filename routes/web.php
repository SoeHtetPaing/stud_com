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

Route::get('/user/{back}/chat', [UserController::class,'chat'])->name('user@chat');


Route::get('/student/setting', [StudentController::class,'setting'])->name('student@setting');
Route::get('/teacher/setting', [LecturerController::class,'setting'])->name('lecturer@setting');
Route::get('/admin/setting', [AdminController::class,'setting'])->name('admin@setting');

Route::post('/admin/addAnnouncement', [AdminController::class, 'addAnnouncement'])->name('admin@addAnnouncement');
Route::post('/admin/addAdmin', [AdminController::class, 'addAdmin'])->name('admin@addAdmin');
Route::post('/admin/addLecturer', [AdminController::class, 'addLecturer'])->name('admin@addLecturer');
Route::post('/admin/addStudent', [AdminController::class, 'addStudent'])->name('admin@addStudent');
Route::post('/admin/addTimetable', [AdminController::class, 'addTimetable'])->name('admin@addTimetable');
Route::post('/admin/addDepartment', [AdminController::class, 'addDepartment'])->name('admin@addDepartment');
Route::post('/admin/createLecturerGroup', [AdminController::class, 'createLecturerGroup'])->name('admin@createLecturerGroup');
Route::post('/admin/createStudentGroup', [AdminController::class, 'createStudentGroup'])->name('admin@createStudentGroup');
Route::post('/admin/createCustomGroup', [AdminController::class, 'createCustomGroup'])->name('admin@createCustomGroup');
Route::post('/admin/addSubject', [AdminController::class, 'addSubject'])->name('admin@addSubject');
Route::post('/admin/addSubjectInTimetable', [AdminController::class, 'addSubjectInTimetable'])->name('admin@addSubjectInTimetable');
Route::post('/admin/announceGrade', [AdminController::class, 'announceGrade'])->name('admin@announceGrade');

Route::get('/admin/manageAnnounce', [AdminController::class, 'manageAnnounce'])->name('admin@manageAnnounce');
Route::get('/admin/manageAnnounce/delete/{id}', [AdminController::class, 'deleteAnnounce'])->name('admin@deleteAnnounce');
Route::get('/admin/manageAnnounce/show/{id}', [AdminController::class, 'showAnnounce'])->name('admin@showAnnounce');
Route::get('/admin/manageAnnounce/edit/{id}', [AdminController::class, 'editAnnounce'])->name('admin@editAnnounce');
Route::post('/admin/manageAnnounce/updateAnnouncePhoto', [AdminController::class, 'updateAnnouncePhoto'])->name('admin@updateAnnouncePhoto');
Route::post('/admin/manageAnnounce/updateAnnounce', [AdminController::class, 'updateAnnounce'])->name('admin@updateAnnounce');


Route::get('/admin/manageUser', [AdminController::class, 'manageUser'])->name('admin@manageUser');
Route::get('/admin/manageUser/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin@deleteUser');
Route::get('/admin/manageUser/edit/{id}', [AdminController::class, 'editUser'])->name('admin@editUser');
Route::post('/admin/manageUser/updateUser', [AdminController::class, 'updateUser'])->name('admin@updateUser');


Route::get('/admin/manageTimetable', [AdminController::class, 'manageTimetable'])->name('admin@manageTimetable');
Route::get('/admin/manageTimetable/deleteAllTimetable', [AdminController::class, 'deleteAllTimetable'])->name('admin@deleteAllTimetable');
Route::get('/admin/manageTimetable/delete/{id}', [AdminController::class, 'deleteTimetable'])->name('admin@deleteTimetable');
Route::get('/admin/manageTimetable/edit/{id}', [AdminController::class, 'editTimetable'])->name('admin@editTimetable');
Route::post('/admin/manageTimetable/updateTimetable', [AdminController::class, 'updateTimetable'])->name('admin@updateTimetable');

Route::get('/admin/manageDepartment', [AdminController::class, 'manageDepartment'])->name('admin@manageDepartment');
Route::get('/admin/manageDepartment/delete/{id}', [AdminController::class, 'deleteDepartment'])->name('admin@deleteDepartment');
Route::get('/admin/manageDepartment/edit/{id}', [AdminController::class, 'editDepartment'])->name('admin@editDepartment');
Route::post('/admin/manageDepartment/updateDepartment', [AdminController::class, 'updateDepartment'])->name('admin@updateDepartment');


Route::get('/admin/manageGroup', [AdminController::class, 'manageGroup'])->name('admin@manageGroup');
Route::get('/admin/manageGroup/delete/{id}', [AdminController::class, 'deleteGroup'])->name('admin@deleteGroup');
Route::get('/admin/manageGroup/edit/{id}', [AdminController::class, 'editGroup'])->name('admin@editGroup');
Route::post('/admin/manageGroup/updateGroup', [AdminController::class, 'updateGroup'])->name('admin@updateGroup');
Route::get('/admin/manageGroup/removeMember/{id}', [AdminController::class, 'removeMember'])->name('admin@removeMember');
Route::post('/admin/manageGroup/addMember', [AdminController::class, 'addMember'])->name('admin@addMember');

Route::get('/admin/manageGrade', [AdminController::class, 'manageGrade'])->name('admin@manageGrade');
Route::get('/admin/manageGrade/delete/{id}', [AdminController::class, 'deleteGrade'])->name('admin@deleteGrade');
Route::get('/admin/manageGrade/edit/{id}', [AdminController::class, 'editGrade'])->name('admin@editGrade');
Route::post('/admin/manageGrade/updateGradeFile', [AdminController::class, 'updateGradeFile'])->name('admin@updateGradeFile');
Route::post('/admin/manageGrade/updateGrade', [AdminController::class, 'updateGrade'])->name('admin@updateGrade');

Route::get('/admin/manageProfile', [AdminController::class, 'manageProfile'])->name('admin@manageProfile');




