<?php

use App\Http\Controllers\AuthContoller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 Route::post('/register',[AuthContoller::class, 'register']);
// Route::post("Auth/register",[AuthContoller::class, 'register'])->name('Auth.register');
Route::post('/login',[AuthContoller::class, 'login']);
Route::get('/infoUser',[AuthContoller::class, 'infoUser'])->middleware('auth:sanctum');
Route::get('/logOut',[AuthContoller::class, 'logOut'])->middleware('auth:sanctum');

Route::post('/createOrUpdategroup',[GroupController::class, 'createOrUpdategroup']);

Route::post('/createOrUpdateCategory',[CategoryController::class, 'createOrUpdateCategory']);
Route::get('/getCategory',[CategoryController::class, 'getCategory']);
Route::get('/getCategoryName',[CategoryController::class, 'getCategoryName']);

Route::post('/createOrUpdateFeature',[FeatureController::class, 'createOrUpdateFeature']);
Route::post('/getFeatureName',[FeatureController::class, 'getFeatureName']);

Route::post('/createOrUpdateProduct',[ProductController::class, 'createOrUpdateProduct']);
Route::get('/getProduct',[ProductController::class, 'getProduct']);
Route::delete('/deleteProduct',[ProductController::class, 'deleteProduct']);
