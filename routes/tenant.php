<?php

Route::get('company/store', 'Tenant\CompanyController@store')->name('company.store');

Route::get('/', function () {
 return 'tenant';
});
