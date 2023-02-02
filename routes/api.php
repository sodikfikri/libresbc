<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\Enum\RouteApiController;
use App\Http\Controllers\Api\ClusterApiController;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Api\SipprofileApiController;

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

// ============================ Enum Route ============================ //
Route::get("/enum/route/failed_list", [RouteApiController::class, "FailedList"]);
Route::get("/enum/route/jobs_list", [RouteApiController::class, "JobList"]);
Route::get("/enum/route", [RouteApiController::class, "List"]);
Route::get("/enum/route/detail", [RouteApiController::class, "Detail"]);
Route::post("/enum/route/add", [RouteApiController::class, "Store"]);
Route::put("/enum/route/update", [RouteApiController::class, "Update"]);
Route::delete("/enum/route/delete", [RouteApiController::class, "Destroy"]);
Route::post("/enum/route/import", [RouteApiController::class, "Import"]);
Route::get("/enum/route/primary_route", [RouteApiController::class, "PrimaryRoute"]);
Route::get("/enum/route/export_data", [RouteApiController::class, "Export"]);

// ============================ Cluster Route ============================ // 
Route::get("/cluster/list", [ClusterApiController::class, "List"]);

// ============================ Base Route ============================ // 
Route::get("/base/natalias/list", [BaseApiController::class, "Natalias_list"]);
Route::get("/base/natalias/detail", [BaseApiController::class, "Natalias_detail"]);

Route::get("/base/gateway/list", [BaseApiController::class, "Gateway_list"]);

// ============================ Sipprofile Route ============================ // 
Route::get("/sipprofile/list", [SipprofileApiController::class, "List"]);