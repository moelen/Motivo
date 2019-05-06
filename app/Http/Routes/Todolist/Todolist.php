<?php

Route::group(['prefix' => 'todolist', 'as' => 'todolist.'], function () {

    Route::get('/', [
        'as'   => 'index',
        'uses' => 'TodolistController@index'
    ]);

    Route::get('/create', [
        'as'   => 'create',
        'uses' => 'TodolistController@create'
    ]);

    Route::post('/create', [
        'uses' => 'TodolistController@store'
    ]);

    Route::get('/{todoList}', [
        'as'   => 'show',
        'uses' => 'TodolistController@show'
    ]);

    Route::get('/{todoList}/destroy', [
        'as'   => 'delete',
        'uses' => 'TodolistController@destroy'
    ]);
});