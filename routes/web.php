<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Auth::routes();

////Route::group(['middleware' => [ 'guest']],function(){
//
//    Route::get('/', function () {
//        return view('auth.login');
//    });
////});



Route::get('/', 'Auth\LoginController@showLoginForm');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth']
    ],
    function(){

    //// ==================================== Dashboard =========================================================///
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    ////====================================  Grade  =========================================================///
    Route::group(['namespace'=>'Grades'],function(){
        Route::resource('grades', 'GradeController');
    });

   ////==================================== ClassesRooms =========================================================///
    Route::group(['namespace'=>'Classrooms'],function(){
        Route::resource('Classrooms', 'ClassroomController');

        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');

    });
    ////==================================== Sections ========================================================= ///
    Route::group(['namespace'=>'Sections'],function(){
        Route::resource('sections', 'SectionController');
        Route::get('/classes/{id}', 'SectionController@getclasses');
    });
    ////=================================== Parents LiveWire =======================================================///
    Route::view('add_parent','livewire.show_Form');

   ////==================================== Teachers =========================================================///
   Route::group(['namespace'=>'Teachers'],function(){
       Route::resource('teachers', 'TeacherController');
   });

   ////==================================== Students =========================================================///
   Route::group(['namespace'=>'Students'],function(){
       Route::resource('students', 'StudentController');
       Route::resource('graduated', 'GraduatedController');
       Route::resource('promotion', 'PromotionController');
       Route::resource('fees', 'FeeController');
       Route::resource('Fees_Invoices', 'FeeInvoiceController');
       Route::resource('receipt_students', 'ReceiptStudentsController');
       Route::resource('ProcessingFee', 'ProcessingFeeController');
       Route::resource('Payment_students', 'PaymentController');
       Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
       Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
       Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
       Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
       Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
   });



    });


