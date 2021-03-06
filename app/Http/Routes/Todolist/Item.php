<?php

Route::group(['prefix' => 'todolist/{todoList}/item', 'as' => 'todolist.item.'], function () {

   Route::get('/create', [
        'as'   => 'create',
        'uses' => 'TodolistItemController@create'
    ]);

    Route::post('/create', [
        'uses' => 'TodolistItemController@store'
    ]);

    Route::post('/order', [
        'as'   => 'order',
        'uses' => 'TodolistItemController@updateOrder'
    ]);

    Route::get('/{todoListItem}/edit', [
        'as'   => 'edit',
        'uses' => 'TodolistItemController@edit'
    ]);

    Route::post('/{todoListItem}/edit', [
        'uses' => 'TodolistItemController@update'
    ]);

    Route::get('/{todoListItem}/destroy', [
        'as'   => 'delete',
        'uses' => 'TodolistItemController@destroy'
    ]);
});