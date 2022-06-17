<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'web'], function () {

    Route::group(['namespace' => 'Frontend'], function () {

        Route::get('/pages/{slug}', 'HomeController@showPage');
        Route::get('/', 'HomeController@rootRedirection');
    });
});


Auth::routes();
Route::get('admin/errors/401', ['as' => 'admin.errors', 'uses' =>  'DashboardController@errorsView']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'check-route-permission']], function () {

    Route::get('/', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@adminDashboard']);

    //Cache and composer autoload management
    Route::get('cache/management', ['as' => 'cache.management', 'uses' => 'DashboardController@cacheManagement']);

    Route::group(['namespace' => 'Admin'], function () {

        // All user module route
        Route::get('user/active/{status?}/{uid?}', ['as' => 'user.status', 'uses' => 'UserController@updateUserStatus']);
        Route::resource('user', 'UserController');
        Route::post('user/roles', ['as' => 'user.userroles', 'uses' => 'UserController@storeUserRoles']);

        // All role module route
        Route::resource('role', 'RoleController');
        Route::post('role/competence', ['as' => 'role.competence', 'uses' => 'RoleController@storeCompetence']);

        // All permission module route
        Route::resource('permission', 'PermissionController');

        // All page module route
        Route::resource('page', 'PageBuilderController');

        // All theme setting module route
        Route::resource('theme', 'FrontendThemeController');

        // Create model view controller from admin side
        Route::resource('module', 'ModuleCreatorController');
        Route::get('module/active/{status?}/{mid?}', ['as' => 'module.status', 'uses' => 'ModuleCreatorController@updateModuleStatus']);

        // All log module route
        Route::get('log/downloads/{file_name?}', ['as' => 'log.downloads', 'uses' => 'LogController@downloads']);
        Route::resource('log', 'LogController');

        // All backup setting module route
        Route::get('backup/download/{file_name?}', ['as' => 'backup.download', 'uses' => 'BackupController@downloads']);
        Route::resource('backup', 'BackupController');

        // All backup setting module route
        Route::get('slider/showconfiguredslider', ['as' => 'slider.showconfiguredslider', 'uses' => 'SliderController@showConfiguredSlider']);
        Route::get('slider/addconfiguredslider', ['as' => 'slider.addconfiguredslider', 'uses' => 'SliderController@addConfiguredSlider']);
        Route::post('slider/addconfiguredslider', ['as' => 'slider.addconfiguredslider', 'uses' => 'SliderController@storeConfiguredSlider']);
        Route::resource('slider', 'SliderController');

        //Custom Modules
        $customModule = (new \App\ACME\MakeRoutes())->getModuleName();
        if ($customModule != null) {
            foreach ($customModule as $module) {
                Route::resource(strtolower($module->module_name), ucwords($module->module_name) . 'Controller');
            }
        }
    });
});
