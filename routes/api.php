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
Route::apiResource('brand', 'Api\BrandController');

Route::resource('category', 'Api\CategoryController');

Route::resource('comment', 'Api\CommentController');

Route::resource('detail-import-product', 'Api\DIPController');

Route::resource('detail-order', 'Api\DOController');

Route::resource('import-product', 'Api\IPController');

Route::resource('order-receipt', 'Api\ORController');

Route::resource('order-status', 'Api\OSController');

Route::resource('product', 'Api\ProductController');

Route::resource('provider', 'Api\ProviderController');

Route::resource('role', 'Api\RoleController');

Route::resource('user', 'Api\UserController');

Route::resource('image', 'Api\ImageController');

Route::resource('property', 'Api\PropertyController');


