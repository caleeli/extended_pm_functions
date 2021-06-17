<?php

Route::group(['middleware' => ['auth']], function () {
    Route::get('admin/extended_pm_functions', 'Extended_pm_functionsController@index')->name('package.skeleton.index');
    Route::get('extended_pm_functions', 'Extended_pm_functionsController@index')->name('package.skeleton.tab.index');
});
