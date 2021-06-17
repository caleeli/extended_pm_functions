<?php
Route::group(['middleware' => ['auth:api', 'bindings']], function() {
    Route::get('admin/extended_pm_functions/fetch', 'Extended_pm_functionsController@fetch')->name('package.skeleton.fetch');
    Route::apiResource('admin/extended_pm_functions', 'Extended_pm_functionsController');
});
