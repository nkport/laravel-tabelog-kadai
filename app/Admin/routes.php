<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\ShopsController;
use App\Admin\Controllers\CompanyController;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\PrivacyPolicyController;
use App\Admin\Controllers\TermsOfServiceController;
use App\Admin\Controllers\AboutController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('categories', CategoryController::class);
    $router->resource('shops', ShopsController::class);
    $router->resource('users', UserController::class);
    $router->resource('companies', CompanyController::class);
    $router->resource('privacy-policies', PrivacyPolicyController::class);
    $router->resource('terms-of-services', TermsOfServiceController::class);
    $router->resource('about', AboutController::class);
    $router->post('shops/import', [ShopsController::class, 'csvImport']);

});
