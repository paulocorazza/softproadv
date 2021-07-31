<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Reports\FinancialProcessController;
use App\Http\Controllers\Reports\HonoraryController;

Route::view('/404-tenant', 'erros.404-tenant')->name('404.tenant');

/*     * ************************************************ */
/*     * *************       LOGIN      ***************** */
/*     * ************************************************ */
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');


/*     * ************************************************ */
/*     * *************  PASSWORD RESET  ***************** */
/*     * ************************************************ */
    Route::post('password/email', 'Auth\ForgotPasswordController@sendresetlinkemail')->name('password.email');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showlinkrequestform')->name('password.request');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reseting');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showresetform')->name('password.reset');


/*     * ************************************************ */
/*     * *************   REGISTRATION   ***************** */
/*     * ************************************************ */
Route::group(['middleware' => ['auth', 'not.domain.main']], function () {
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->name('');
});


//Choose a Plan
/*     * ************************************************ */
/*     * *************   CHOOSE A PLAN  ***************** */
/*     * ************************************************ */
    Route::get('plans/choosePlan',
    'Tenant\PlanController@choosePlan')->middleware('not.domain.main')->name('plans.choosePlan');

    Route::get('paypal/{companyUuid}/{id}',
    'Tenant\AgreementController@createAgreement')->name('paypal.agreement')->middleware('not.domain.main');

    Route::get('paypal/return', 'Tenant\AgreementController@execute')->name('paypal.return');


/*     * ************************************************ */
/*     * *************      PAYPAL      ***************** */
/*     * ************************************************ */
Route::group(['namespace' => 'Tenant', 'middleware' => 'auth'], function () {

    Route::get('paypal/create/{id}', 'SubscriptionController@createPlan')->name('paypal.create');
    Route::get('paypal/list', 'SubscriptionController@listPlan')->name('paypal.list');
    Route::get('paypal/{id}', 'SubscriptionController@showPlan');
    Route::get('paypal/{id}/activate', 'SubscriptionController@activatePlan');
    Route::get('paypal/{id}/detail', 'AgreementController@detailAgreement');
});


Route::group(['namespace' => 'Site'], function () {
    /*     * ************************************************ */
    /*     * *************      REGISTER      ***************** */
    /*     * ************************************************ */
    Route::post('register-company', 'IndexController@register')->name('register.company');
    Route::get('register-show', 'IndexController@showRegister')->name('register.show');
    Route::get('/', 'IndexController@index')->name('index');
});




/*     * ************************************************ */
/*     * *************      SYSTEM      ***************** */
/*     * ************************************************ */
Route::group(['middleware' => 'auth'], function () {



    /*     * ************************************************ */
    /*     * *************     COUNTRIES    ***************** */
    /*     * ************************************************ */
    Route::get('countries/{id}/states', 'CountryController@getStates');
    Route::resource('countries', 'CountryController');


    /*     * ************************************************ */
    /*     * *************       STATES     ***************** */
    /*     * ************************************************ */
    Route::get('states/{id}/cities', 'StateController@getCities');

    Route::resource('states', 'StateController');


    /*     * ************************************************ */
    /*     * *************       CITIES     ***************** */
    /*     * ************************************************ */
    Route::resource('cities', 'CityController');


    /*     * ************************************************ */
    /*     * *************    TYPE ADDRESS  ***************** */
    /*     * ************************************************ */
    Route::resource('type-address', 'TypeAddressController');


    /*     * ************************************************ */
    /*     * *************  SEARCH ADDRESS  ***************** */
    /*     * ************************************************ */
     Route::get('search/{cep}/address', 'SearchAddressController@search')->name('search.address');

    /*     * ************************************************ */
    /*     * *************       ADDRESS    ***************** */
    /*     * ************************************************ */
    Route::post('address/delete', 'ExtraAction\AddressDestroy')->name('delete_address');

    /*     * ************************************************ */
    /*     * *************       CONTACT    ***************** */
    /*     * ************************************************ */
    Route::post('contact/delete', 'ExtraAction\ContactDestroy')->name('delete_contact');


    /*     * ************************************************ */
    /*     * *************      USERS      ***************** */
    /*     * ************************************************ */
    Route::get('users/{id}/profile', 'UserController@profiles')->name('users.profiles');
    Route::get('users/{id}/profile/{profileId}/delete', 'UserController@userDeleteProfile')->name('users.profile.delete');

    Route::get('users/{id}/profile/register', 'UserController@listProfileAdd')->name('users.profiles.list');
    Route::post('users/{id}/profile/register', 'UserController@userAddProfile')->name('users.profiles.add');


    Route::resource('users', 'UserController');

    Route::get('profile', 'UserController@showProfile')->name('profile');
    Route::put('profile/{id}', 'UserController@updateProfile')->name('profile.update');
    Route::put('profile/{id}/reset', 'UserController@resetPassword')->name('profile.password');


    /*     * ************************************************ */
    /*     * *************      PROFILES    ***************** */
    /*     * ************************************************ */
    Route::get('profiles/{id}/user', 'ProfileController@users')->name('profiles.users');
    Route::get('profiles/{id}/user/register', 'ProfileController@listUsersAdd')->name('profiles.users.list');
    Route::post('profiles/{id}/user/register', 'ProfileController@userAddProfile')->name('profiles.users.add');
    Route::get('profiles/{id}/user/{userId}/delete', 'ProfileController@userDeleteProfile')->name('profiles.users.delete');

    Route::get('profiles/{id}/permission', 'ProfileController@permissions')->name('profiles.permissions');
    Route::get('profiles/{id}/permission/register', 'ProfileController@listPermissionAdd')->name('profiles.permissions.list');
    Route::post('profiles/{id}/permission/register', 'ProfileController@permissionAddProfile')->name('profiles.permissions.add');
    Route::get('profiles/{id}/permission/{permissionId}/delete', 'ProfileController@permissionDeleteProfile')->name('profiles.permissions.delete');

    Route::resource('profiles', 'ProfileController');


    /*     * ************************************************ */
    /*     * *************    PERMISSION    ***************** */
    /*     * ************************************************ */
    Route::get('permissions/{id}/profile', 'PermissionController@profiles')->name('permissions.profiles');
    Route::get('permissions/{id}/profile/{profileId}/delete', 'PermissionController@permissionDeleteProfile')->name('permissions.profile.delete');

    Route::get('permissions/{id}/profile/register', 'PermissionController@listProfileAdd')->name('permissions.profiles.list');

    Route::post('permissions/{id}/profile/register', 'PermissionController@permissionAddProfile')->name('permissions.profile.add');
    Route::resource('permissions', 'PermissionController');


    Route::get('/home', 'HomeController@index')->name('home');


    /*     * ************************************************ */
    /*     * *************      ORIGIN      ***************** */
    /*     * ************************************************ */
    Route::resource('origins', 'OriginController');


    /*     * ************************************************ */
    /*     * *************       PERSON     ***************** */
    /*     * ************************************************ */
    Route::post('people/search', 'ExtraAction\People');
    Route::resource('people', 'PersonController');


    /*     * ************************************************ */
    /*     * *************       FORUM      ***************** */
    /*     * ************************************************ */
    Route::resource('forums', 'ForumController');


    /*     * ************************************************ */
    /*     * *************       STICK      ***************** */
    /*     * ************************************************ */
    Route::resource('sticks', 'StickController');


    /*     * ************************************************ */
    /*     * *************     DISTRICT     ***************** */
    /*     * ************************************************ */
    Route::get('districts/{id}/sticks', 'DistrictController@sticks')->name('districts.sticks');
    Route::get('districts/{id}/sticks/register', 'DistrictController@listSticks')->name('districts.sticks.list');

    Route::post('districts/{id}/sticks/register', 'DistrictController@AddSticks')->name('districts.sticks.add');
    Route::get('districts/{id}/sticks/{stickId}/delete', 'DistrictController@deleteStick')->name('districts.sticks.delete');

    Route::resource('districts', 'DistrictController');

    /*     * ************************************************ */
    /*     * *************   GROUP ACTION   ***************** */
    /*     * ************************************************ */
    Route::get('/group-actions/{id}/type-actions', 'ExtraAction\GroupTypeActions');
    Route::resource('group-actions', 'GroupActionController');


    /*     * ************************************************ */
    /*     * *************   TYPE ACTION   ***************** */
    /*     * ************************************************ */
    Route::get('type-actions/{id}/phases', 'TypeActionController@phases')->name('type-actions.phases');

    Route::get('type-actions/{id}/phasesSelect', 'TypeActionController@phasesSelect')->name('type-actions.phasesSelect');

    Route::get('type-actions/{id}/phase/register', 'TypeActionController@listPhaseAdd')->name('type-actions.phases.list');

    Route::get('type-actions/{id}/phase/{phaseId}/delete', 'TypeActionController@typeActionDeletePhase')->name('type-actions.phase.delete');

    Route::post('type-actions/{id}/phase/register', 'TypeActionController@typeActionAddPhase')->name('type-actions.phase.add');

    Route::resource('type-actions', 'TypeActionController');


    /*     * ************************************************ */
    /*     * *************        PHASE     ***************** */
    /*     * ************************************************ */
    Route::get('phases/{id}/stagesSelect', 'PhaseController@stagesSelect')->name('stages.stageSelect');
    Route::resource('phases', 'PhaseController');

    /*     * ************************************************ */
    /*     * *************        STAGE     ***************** */
    /*     * ************************************************ */
    Route::resource('stages', 'StageController');

    /*     * ************************************************ */
    /*     * *************      PROCESS     ***************** */
    /*     * ************************************************ */


    Route::get('process/processSelect', 'ExtraAction\PersonProcess')->name('processes.select');
    Route::get('process/search', 'ExtraAction\Process');
    Route::get('process/file/{id}/download', 'ExtraAction\ProcessFileDownload')->name('fileDownload');

    Route::get('process/file/{id}', 'ExtraAction\ProcessFileView')->name('fileView');

    Route::post('process/file/delete', 'ExtraAction\ProcessFileDestroy')->name('fileDelete');

    Route::post('process/progress/delete', 'ExtraAction\ProcessProgressDestroy')->name('progressDelete');
    Route::post('process/audience/delete', 'ExtraAction\ProcessAudienceDestroy')->name('AudienceDelete');
    Route::get('process/stage/{id}/delete', 'ExtraAction\ProcessStageController')->name('stageDelete');

    Route::get('processes/{id}/preview', 'ProcessContractController@preview')->name('processes.contract.preview');
    Route::get('processes/{id}/contract', 'ProcessContractController@contract')->name('processes.contract');
    Route::put('processes/{id}/contract', 'ProcessContractController@updateContract')->name('processes.contract.update');
    Route::resource('processes', 'ProcessController');



    /*     * ************************************************ */
    /*     * *************     EVENTS     ***************** */
    /*     * ************************************************ */
    Route::post('events/finish', 'EventController@finish');
    Route::get('events/file/{id}/download', 'ExtraAction\EventFileDownload')->name('events.fileDownload');
    Route::resource('events', 'EventController');



    /*     * ************************************************ */
    /*     * *************   FULL CALENDAR   **************** */
    /*     * ************************************************ */
    Route::get('schedule', 'ScheduleController@index')->name('calendar.index');
    Route::get('schedule/events', 'ScheduleController@loadEvents')->name('routeLoadEvents');
    Route::get('schedule/events/user', 'ScheduleController@loadUser')->name('routeLoadUser');
    Route::post('schedule/event-store', 'ScheduleController@store')->name('routeEventStore');
    Route::put('schedule/event-update', 'ScheduleController@update')->name('routeEventUpdate');
    Route::delete('schedule/event-destroy', 'ScheduleController@destroy')->name('routeEventDelete');



    /*     * ************************************************ */
    /*     * ***********  FINANCIAL CATEGORY  *************** */
    /*     * ************************************************ */
    Route::post('financial-category/search', 'ExtraAction\FinancialCategory');
    Route::resource('financial-category', 'FinancialCategoryController');

    /*     * ************************************************ */
    /*     * ***********  FINANCIAL ACCOUNT   *************** */
    /*     * ************************************************ */
    Route::post('financial-account/search', 'ExtraAction\FinancialAccount');
    Route::resource('financial-account', 'FinancialAccountController');


    /*     * ************************************************ */
    /*     * ***********       FINANCIAL      *************** */
    /*     * ************************************************ */
    Route::resource('financial', 'FinancialController');


    /*     * ************************************************ */
    /*     * *************    CONTRACTS     ***************** */
    /*     * ************************************************ */
    Route::resource('contracts', 'ContractModelController');


    /*     * ************************************************ */
    /*     * ***********       REPORTS      *************** */
    /*     * ************************************************ */
    Route::get('reports/honorary', [HonoraryController::class, 'index']);
    Route::post('reports/honorary/pdf', [HonoraryController::class, 'report'])->name('honorary.report');

    Route::get('reports/financial-process', [FinancialProcessController::class, 'index']);
    Route::post('reports/financial-process/pdf', [FinancialProcessController::class, 'report'])->name('financial.process.report');


    Route::get('reports/financial', [\App\Http\Controllers\Reports\FinancialController::class, 'index']);
    Route::post('reports/financial', [\App\Http\Controllers\Reports\FinancialController::class, 'report'])->name('financial.report');

    Route::get('reports/people', [\App\Http\Controllers\Reports\PeopleController::class, 'report'])->name('people.report');

});




Route::get('/teste', function () {
    $_sUrl ='http://pedro.softproadv-homolog.com.br';

    $cl = curl_init($_sUrl);
    curl_setopt($cl,CURLOPT_VERBOSE, true);
    curl_setopt($cl,CURLOPT_CONNECTTIMEOUT,1);
    curl_setopt($cl,CURLOPT_HEADER,true);
    curl_setopt($cl,CURLOPT_NOBODY,true);
    curl_setopt($cl,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($cl,CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($cl);
    curl_close($cl);

    dd($response ?? true);

});


URL::forceScheme('https');
