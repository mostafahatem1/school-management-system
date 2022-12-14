<?php

use App\Models\Student;
use App\Models\Teacher;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {
        //Query Builder
//        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
//        $count_sections =  $ids->count();
//        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();

        //Eloquent
        $section_ids=Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['count_sections']= $section_ids->count();
        $data['count_students']= Student::whereIn('section_id',$section_ids)->count();
        return view('pages.Teachers.dashboard.dashboard',$data);
    });
    ////==================================== Students =========================================================///
    Route::group(['namespace'=>'Teachers\dashboard'],function(){

        Route::get('student','StudentController@index')->name('student.index');
        Route::get('section','StudentController@sections')->name('section.index');

        Route::post('attendance','StudentController@attendance')->name('attendance');

        Route::get('attendance_report','StudentController@attendanceReport')->name('attendance.report');
        Route::post('attendance_report','StudentController@attendanceSearch')->name('attendance.search');

        Route::resource('quizzes', 'QuizzesController');

        Route::resource('questions', 'QuestionController');

        Route::resource('online_zoom_classes', 'OnlineZoomClassesController');
        Route::get('/indirect/create', 'OnlineZoomClassesController@indirectCreate')->name('indirect.teacher.create');
        Route::post('/indirect/store', 'OnlineZoomClassesController@storeIndirect')->name('indirect.teacher.store');

        Route::get('profile', 'ProfileController@index')->name('profile.show');
        Route::post('profile/{id}', 'ProfileController@update')->name('profile.update');

        Route::get('student_quiz/{id}','QuizzesController@student_quizze')->name('student.quiz');
        Route::post('repeat_quiz', 'QuizzesController@repeat_quizze')->name('repeat.quiz');
    });

});
