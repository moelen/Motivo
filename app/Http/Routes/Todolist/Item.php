<?php

Route::group(['prefix' => 'todolist/{todoList}', 'as' => 'todolist.item.'], function () {

   Route::get('create', [
        'as'   => 'create',
        'uses' => 'TodolistItemController@create'
    ]);

    Route::post('create', [
        'uses' => 'TodolistItemController@store'
    ]);
});