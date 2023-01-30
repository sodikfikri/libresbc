<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Enum\RouteApiController;
use App\Http\Controllers\Api\AuthApiController;

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

Route::post("/login", [AuthApiController::class, "Login"]);

Route::get("/enum/route", [RouteApiController::class, "List"]);
Route::get("/enum/route/detail", [RouteApiController::class, "Detail"]);
Route::post("/enum/route/add", [RouteApiController::class, "Store"]);
Route::put("/enum/route/update", [RouteApiController::class, "Update"]);
Route::delete("/enum/route/delete", [RouteApiController::class, "Destroy"]);
Route::post("/enum/route/import", [RouteApiController::class, "Import"]);
Route::get("/enum/route/primary_route", [RouteApiController::class, "PrimaryRoute"]);
Route::get("/enum/route/export_data", [RouteApiController::class, "Export"]);
