<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\Admin\BusinessController;
// use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\Business\ServiceController;
// use App\Http\Controllers\BookingsController;
// use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix'=>'auth'], function($router){
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function(){
Route::get('/user-profile', [AuthController::class, 'userProfile']);
Route::post('/logout', [AuthController::class, 'logout']);
});
});


Route::group(['prefix'=>'brands'], function($router){
    Route::controller(BrandController::class)->group(function(){
        Route::get('index','index');
        Route::get('show/{id}','show');
        Route::post('store','store');
        Route::put('update_brand/{id}','update');
        Route::delete('delete_brand/{id}','delete');
        });
});

Route::group(['prefix'=>'category'], function($router){
    Route::controller(CategoryController::class)->group(function(){
        Route::get('index','index');
        Route::get('show/{id}','show');
        Route::post('store','store');
        Route::put('update_category/{id}','update');
        Route::delete('delete_category/{id}','delete');
        });

});
Route::group(['prefix'=>'location'], function($router){
    Route::controller(LocationController::class)->group(function(){
        // Route::get('index','index');
        Route::post('store','store');
        Route::put('update/{id}','update');
        Route::delete('destroy/{id}','destroy');
        });
});
Route::group(['prefix'=>'product'], function($router){
    Route::controller(ProductController::class)->group(function(){
        Route::get('index','index');
        Route::post('store','store');
        Route::get('show/{id}','show');
        Route::put('update/{id}','update');
        Route::delete('destroy/{id}','destroy');
        });
});
Route::group(['prefix'=>'orders'], function($router){
    Route::controller(OrderController::class)->group(function(){
        Route::get('index','index');
        Route::post('store','store');
        Route::get('show/{id}','show');
        Route::get('get_order_items/{id}','get_order_items');
        Route::get('get_order_orders/{id}','get_order_orders');
        Route::post('change_order_status/{id}','change_order_status');
        });
});





// Route::middleware('auth:sanctum')->group(function(){
//     Route::apiResource('service', ServiceController::class);
//     Route::post('update_service/{id}', [ServiceController::class, 'update']);

//     Route::apiResource('booking', BookingsController::class);
//     Route::post('update_booking/{id}', [BookingsController::class, 'update']);

//     Route::apiResource('review', ReviewsController::class);
//     Route::post('business_reviews/{id}', [ReviewsController::class, 'business_reviews']);
//     Route::post('update_reviews/{id}', [ReviewsController::class, 'business_update']);
// });


    

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/auth', function (Request $request){
    return response()->json(['message login first']);
})->name('auth');
// Route::group([
//     'middleware' => 'api',
//     'prefix' => 'auth'
// ], function ($router) {
//     Route::post('/login', [AuthController::class, 'login']);
//     Route::post('/register', [AuthController::class, 'register']);
//     Route::post('/logout', [AuthController::class, 'logout']);
//     Route::post('/refresh', [AuthController::class, 'refresh']);
//     Route::get('/user-profile', [AuthController::class, 'userProfile']);    
// });