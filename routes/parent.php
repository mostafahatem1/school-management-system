<?php

use App\Models\Student;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parent/dashboard', function () {
        $sons=Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.dashboard.dashboard',compact('sons'));
    });

    Route::group(['namespace' => 'Parents\dashboard'], function () {
        Route::get('children', 'ChildrenController@index')->name('sons.index');
        Route::get('results/{id}', 'ChildrenController@results')->name('sons.results');

    });


});
