<?php


use App\Models\Message;
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
//Auth::routes();

////Route::group(['middleware' => [ 'guest']],function(){
//
//    Route::get('/', function () {
//        return view('auth.login');
//    });
////});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function(){
    //// ==================================== Multi Auth =========================================================///
        Route::get('/', 'HomeController@index')->name('selection')->middleware('guest');

        Route::group(['namespace' => 'Auth'], function () {

            Route::get('/login/{type}','LoginController@loginForm')->name('login.show');
            Route::post('/login','LoginController@login')->name('login');

            Route::get('/logout/{type}', 'LoginController@logout')->name('logout');

        });

    });




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth']
    ],
    function(){

    //// ==================================== Dashboard =========================================================///
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    ////====================================  Grade  =========================================================///


   ////==================================== ClassesRooms =========================================================///

    ////==================================== Sections ========================================================= ///
    Route::group(['namespace'=>'Sections'],function(){
        Route::resource('sections', 'SectionController');
        Route::get('/classes/{id}', 'SectionController@getclasses');
    });
    ////=================================== Parents LiveWire =======================================================///
    Route::view('add_parent','livewire.show_Form')->name('add_parent');

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
       Route::resource('Attendance', 'AttendanceController');
       Route::resource('online_classes', 'OnlineClassesController');
       Route::resource('library', 'LibraryController');
       Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
       Route::get('/indirect', 'OnlineClassesController@indirectCreate')->name('indirect.create');
       Route::post('/indirect', 'OnlineClassesController@storeIndirect')->name('indirect.store');
       Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
       Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
       Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
   });

   ////=========================================== Subjects =======================================================////
   Route::group(['namespace' => 'Subjects'], function () {
      Route::resource('subjects', 'SubjectController');
   });
   ////=========================================== Quizzes ========================================================////
   Route::group(['namespace' => 'Quizzes'], function () {
       Route::resource('Quizzes', 'QuizController');
   });
   ////=========================================== Questions ======================================================////

   Route::group(['namespace' => 'questions'], function () {
        Route::resource('questions', 'QuestionController');
   });
   ////==================================== About =========================================================///

   Route::resource('abouts', 'AboutController');

    });







