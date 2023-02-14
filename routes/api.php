<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\Enum\RouteApiController;
use App\Http\Controllers\Api\ClusterApiController;
use App\Http\Controllers\Api\BaseApiController;
use App\Http\Controllers\Api\SipprofileApiController;
use App\Http\Controllers\Api\ClassApiController;
use App\Http\Controllers\Api\InterConnectionApiController;
use App\Http\Controllers\Api\RoutingApiController;
use App\Http\Controllers\Api\UserManagementApiController;

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

// Route::post("/login", [AuthApiController::class, "Login"])->name('login');

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
Route::get("/enum/route/master_primary", [RouteApiController::class, "GetMasterPrimary"]);

// ============================ Cluster Route ============================ // 
Route::get("/cluster/list", [ClusterApiController::class, "List"]);

// ============================ Base Route ============================ // 
Route::get("/base/natalias/list", [BaseApiController::class, "Natalias_list"]);
Route::get("/base/natalias/detail", [BaseApiController::class, "Natalias_detail"]);

Route::get("/base/gateway/list", [BaseApiController::class, "Gateway_list"]);
Route::get("/base/gateway/detail", [BaseApiController::class, "Gateway_detail"]);

// ============================ Sipprofile Route ============================ // 
Route::get("/sipprofile/list", [SipprofileApiController::class, "List"]);
Route::get("/sipprofile/detail", [SipprofileApiController::class, "Detail"]);

// ============================ Class Route ============================ // 
Route::get("/class/media/list", [ClassApiController::class, "Media_list"]);
Route::get("/class/media/detail", [ClassApiController::class, "Media_detail"]);

Route::get("/class/capacity/list", [ClassApiController::class, "Capacity_list"]);
Route::get("/class/capacity/detail", [ClassApiController::class, "Capacity_detail"]);


Route::get("/class/translation/list", [ClassApiController::class, "Translation_list"]);
Route::get("/class/translation/detail", [ClassApiController::class, "Translation_detail"]);

Route::get("/class/manipulation/list", [ClassApiController::class, "Manipulation_list"]);
Route::get("/class/manipulation/detail", [ClassApiController::class, "Manipulation_detail"]);

// ============================ Class Route ============================ // 
Route::get("/inter/inbound/list", [InterConnectionApiController::class, "InBound_list"]);
Route::get("/inter/inbound/detail", [InterConnectionApiController::class, "InBound_detail"]);

Route::get("/inter/outbound/list", [InterConnectionApiController::class, "OutBound_list"]);
Route::get("/inter/outbound/detail", [InterConnectionApiController::class, "OutBound_detail"]);

// ============================ Routing Route ============================ // 
Route::get("/routing/table/list", [RoutingApiController::class, "Table_list"]);
Route::get("/routing/table/detail", [RoutingApiController::class, "Table_detail"]);

// ============================ Routing Route ============================ // 
Route::get("/user_manage/user_list", [UserManagementApiController::class, "user_list"]);
