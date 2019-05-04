<?php

Route::group(['prefix' => 'todolist', 'as' => 'todolist.'], function () {
    Route::get('create', [
        'as'   => 'create',
        'uses' => 'TodolistController@create'
    ]);

    Route::post('create', [
        'uses' => 'TodolistController@store'
    ]);
});