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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:teacher,web,parent,student',]
    ], function () {


    ////==================================== Chat =========================================================///
        ///
    Route::group(['namespace'=>'livewire'],function(){
        //livewire routes
        Route::get('/chats', function () {
            return view('livewire.show-chat');
        })->name('show-chat');

        Route::get('delete_chat', function () {
            Message::truncate();
            return redirect()->route('show-chat');

        })->name('delete_chat');

    });

});
