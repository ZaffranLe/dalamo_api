<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('admin/brand', 'Api\Admin\BrandController');

Route::apiResource('admin/category', 'Api\Admin\CategoryController');

Route::apiResource('admin/comment', 'Api\Admin\CommentController');

Route::apiResource('admin/detail-import-product', 'Api\Admin\DIPController');

Route::apiResource('admin/detail-order', 'Api\Admin\DOController');

Route::apiResource('admin/import-product', 'Api\Admin\IPController');

Route::apiResource('admin/order-receipt', 'Api\Admin\ORController');

Route::apiResource('admin/order-status', 'Api\Admin\OSController');

Route::apiResource('admin/product', 'Api\Admin\ProductController');

Route::apiResource('admin/provider', 'Api\Admin\ProviderController');

Route::apiResource('admin/role', 'Api\Admin\RoleController');

Route::apiResource('admin/user', 'Api\Admin\UserController');

Route::apiResource('admin/image', 'Api\Admin\ImageController');

Route::apiResource('admin/property', 'Api\Admin\PropertyController');


