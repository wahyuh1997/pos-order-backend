<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\PesananController;

Route::prefix('customer')->group(function(){
    Route::get('/get_order/{code}', [PesananController::class, 'get_qr_code']);
    
    Route::post('/insert_order_detail/{id}', [PesananController::class, 'insert_order_detail']);
    Route::put('/update_order/{id}', [PesananController::class, 'update_order']);
    Route::put('/update_order/{id}', [PesananController::class, 'update_order']);
});


Route::post('/register', [AuthController::class, 'register']);
    
Route::post('/login', [AuthController::class, 'login']);

Route::get('/set_role', [AuthController::class, 'set_role']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/home', function(Request $request) {
        return $request->user();
    });
    
    Route::get('/logout', [AuthController::class, 'logout']);
    
    
    Route::prefix('menu')->group(function(){
        // Kategori Menu
        Route::post('/create_category', [MenuController::class, 'create_category']);
        Route::get('/get_category/{id}', [MenuController::class, 'get_category']);
        Route::get('/get_all_category', [MenuController::class, 'get_all_category']);
        Route::delete('/delete_category/{id}', [MenuController::class, 'delete_category']);
        Route::put('/update_category/{id}', [MenuController::class, 'update_category']);
    
        // Menu
        Route::get('/get_menu/{id}', [MenuController::class, 'get_menu']);
        Route::post('/insert_menu', [MenuController::class, 'insert_menu']);
        Route::get('/get_all_menu', [MenuController::class, 'get_all_menu']);
        Route::put('/edit_menu/{id}', [MenuController::class, 'edit_menu']);
        Route::delete('/delete_menu/{id}', [MenuController::class, 'delete_menu']);
        
        Route::delete('/delete_attribute/{nama}', [MenuController::class, 'delete_attribute']);
        Route::get('/get_name_attribute', [MenuController::class, 'get_name_attribute']);
    });
    
    Route::prefix('order')->group(function(){
        Route::post('/insert_order', [PesananController::class, 'insert_order']);
        Route::get('/get_order/{id}', [PesananController::class, 'get_order']);
        Route::get('/get_all_order', [PesananController::class, 'get_all_order']);
        Route::put('/update_order/{id}', [PesananController::class, 'update_order']);
        
        Route::post('/insert_order_detail/{id}', [PesananController::class, 'insert_order_detail']);
    });

    Route::prefix('dapur')->prefix(function(){
        Route::get('/get_all_order', [PesananController::class, 'get_all_order']);
        Route::get('/update', [PesananController::class, 'update_order']);
    });



});
