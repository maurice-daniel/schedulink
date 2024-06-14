<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ScheduleController;




Route::get('/', function () {
    return view('auth.login');
});
Route::controller(AuthController::class)->group(function () {
    Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [AuthController::class, 'updateProfile'])->name('update-profile');
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
  
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
  
    Route::post('logout', 'logout')->middleware('auth')->name('logout');

});
  
Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
 
    Route::resource('/faculty', FacultyController::class);
    Route::resource('/subject', SubjectController::class);
    Route::resource('/room', RoomController::class);
    Route::resource('/section', SectionController::class);


    Route::get('/dashboard', [ScheduleController::class, 'index'])->name('dashboard');
    Route::post('/assign-schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::post('/get-faculty-schedule', [ScheduleController::class, 'getFacultySchedule'])->name('get-faculty-schedule');
    Route::post('/get-faculty-schedule', [ScheduleController::class, 'fetchFacultySchedule'])->name('get-faculty-schedule');





    Route::get('/profile', [App\Http\Controllers\AuthController::class, 'profile'])->name('profile');
});