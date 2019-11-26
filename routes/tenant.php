<?php
Route::group(['namespace' => 'Tenant', 'middleware' => 'auth'], function () {

    Route::resource('companies', 'CompanyController');

    Route::get('/', 'TenantController@index')->name('tenants');
});



