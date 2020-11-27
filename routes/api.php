<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\RoleEnum;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api');

Route::group(['middleware' => ['admin']], function () {
    Route::apiResource('admin/dashboard', 'Api\Admin\DashboardController');

    Route::apiResource('admin/brand', 'Api\Admin\BrandController');

    Route::apiResource('admin/category', 'Api\Admin\CategoryController');

    Route::apiResource('admin/comment', 'Api\Admin\CommentController');

    Route::apiResource('admin/order-receipt', 'Api\Admin\ORController');

    Route::apiResource('admin/order-status', 'Api\Admin\OSController');

    Route::apiResource('admin/product', 'Api\Admin\ProductController');

    Route::apiResource('admin/provider', 'Api\Admin\ProviderController');

    Route::apiResource('admin/role', 'Api\Admin\RoleController');

    Route::apiResource('admin/user', 'Api\Admin\UserController');
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout')->middleware('verify.jwt');
Route::post('/test', 'AuthController@test');

Route::apiResource('client/brand', 'Api\Client\BrandController');

Route::apiResource('client/category', 'Api\Client\CategoryController');

Route::apiResource('client/comment', 'Api\Client\CommentController');

Route::apiResource('client/detail-import-product', 'Api\Client\DIPController');

Route::apiResource('client/detail-order', 'Api\Client\DOController');

Route::apiResource('client/import-product', 'Api\Client\IPController');

Route::apiResource('client/order-receipt', 'Api\Client\ORController');

Route::apiResource('client/order-status', 'Api\Client\OSController');

Route::apiResource('client/product', 'Api\Client\ProductController');

Route::apiResource('client/provider', 'Api\Client\ProviderController');

Route::apiResource('client/role', 'Api\Client\RoleController');

Route::apiResource('client/user', 'Api\Client\UserController');

Route::apiResource('client/image', 'Api\Client\ImageController');

Route::apiResource('client/property', 'Api\Client\PropertyController');
