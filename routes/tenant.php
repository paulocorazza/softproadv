<?php
Route::get('verify-domain', 'Tenant\CompanyController@verifyDomain');


Route::group(['namespace' => 'Tenant', 'middleware' => 'auth'], function () {

    Route::resource('companies', 'CompanyController');
    Route::resource('plans', 'PlanController');

    Route::get('/', 'TenantController@index')->name('tenants');
});



