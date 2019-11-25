<?php
Route::group(['namespace' => 'Tenant', 'middleware' => 'auth'], function () {

    Route::any('companies/search', 'CategoryController@search')->name('companies.search');
    Route::resource('companies', 'CompanyController');

    Route::get('/', 'TenantController@index')->name('tenants');
});


