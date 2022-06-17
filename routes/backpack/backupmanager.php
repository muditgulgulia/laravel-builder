<?php
/*
|--------------------------------------------------------------------------
| Backpack\BackupManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\BackupManager package.
|
*/
Route::group([
    'namespace' => 'Admin',
    'prefix' => 'admin',
    'middleware' => ['web', 'auth', 'check-route-permission'],
], function () {
    Route::get('backup', 'BackupController@index');
    Route::put('backup/create', 'BackupController@create');
    Route::get('backup/download/{file_name?}', 'BackupController@download');
    Route::delete('backup/delete/{file_name?}', 'BackupController@delete')->where('file_name', '(.*)');
});