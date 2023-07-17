<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ], function () {

    //==============================dashboard============================
    Route::get('/student/dashboard', function () {
        return view('pages.Students.dashboard.dashboard');
    });

    Route::group(['namespace' => 'Students\dashboard'], function () {
        //===================== student_quizzes =========================================================//
        Route::resource('student_quizzes', 'QuizzesController');

        //===================== subject_student =========================================================//
        Route::resource('subject_student', 'libraryController');
        Route::get('library_student_attachment/{filename}', 'libraryController@library_student_attachment')->name('subject.student.attachment');


        //===================== subjects =========================================================//
        Route::resource('profile-student', 'ProfileController');



    });


});
