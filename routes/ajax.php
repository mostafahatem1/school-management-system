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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:teacher,web',]
    ], function () {

    //============================== Ajax ============================//
    Route::group(['namespace'=>'Ajax'],function(){
        Route::get('/Get_classrooms/{id}', 'AjaxController@Get_classrooms');
        Route::get('/Get_Sections/{id}', 'AjaxController@Get_Sections');

    });
});
