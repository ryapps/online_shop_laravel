<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AuthController;

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

Route::post("/insert_produk",[ ProductController::class, "store"]);
Route::get("/get_produk",[ ProductController::class, "index"]);
Route::get("/get_produk/{id}",[ ProductController::class, "show"]);
Route::put("/put_produk/{id}",[ ProductController::class, "update"]);
Route::delete("/delete_produk/{id}",[ ProductController::class, "destroy"]);

Route::post("/insert_pelanggan",[ CustomerController::class, "store"]);
Route::get("/get_pelanggan",[ CustomerController::class, "index"]);
Route::get("/get_pelanggan/{id}",[ CustomerController::class, "show"]);
Route::put("/put_pelanggan/{id}",[ CustomerController::class, "update"]);
Route::delete("/delete_pelanggan/{id}",[ CustomerController::class, "destroy"]);

Route::post("/insert_petugas",[ PetugasController::class, "store"]);
Route::get("/get_petugas",[ PetugasController::class, "index"]);
Route::get("/get_petugas/{id}",[ PetugasController::class, "show"]);
Route::put("/put_petugas/{id}",[ PetugasController::class, "update"]);
Route::delete("/delete_petugas/{id}",[ PetugasController::class, "destroy"]);

Route::post('/register', [AuthController::class, "register"]);
Route::get("/get_user",[AuthController::class,"getUser"]);
Route::get("/get_detail_user/{id}",[AuthController::class,"getDetailUser"]);
Route::put("/update_user/{id}",[AuthController::class,"update_user"]);
Route::delete("/delete_user/{id}",[AuthController::class,"delete_user"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
