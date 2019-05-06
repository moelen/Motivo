<?php

Route::group(['prefix' => 'attachment', 'as' => 'attachment.'], function () {

   Route::get('/{attachment}/download', [
        'as'   => 'download',
        'uses' => 'AttachmentController@download'
    ]);
});