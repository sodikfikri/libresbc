<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\SipprofileController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\InterConnectionController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\UserManagementController;

use App\Http\Controllers\Api\AuthApiController;

use App\Http\Controllers\Enum\RouteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::group(['middleware' => ['token.verify']], function() {
    Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->name('dashboard');
    
    Route::get('/cluster', [ClusterController::class, 'index'])->name('cluster-list');
    
    Route::get('/base/natalias', [BaseController::class, 'natalias_list'])->name('base-natalias-list');
    Route::get('/base/firewall', [BaseController::class, 'firewall_list'])->name('base-firewall-list');
    Route::get('/base/gateway', [BaseController::class, 'gateway_list'])->name('base-gateway-list');
    Route::get('/base/acl', [BaseController::class, 'acl_list'])->name('base-acl-list');
    
    Route::get('/sipprofile', [SipprofileController::class, 'index'])->name('sipprofile-list');
    Route::get('/sipprofile/detail', [SipprofileController::class, 'detail'])->name('sipprofile-detail');
    
    Route::get('/class/capacity', [ClassController::class, 'capacity'])->name('capacity-list');
    Route::get('/class/manipulation', [ClassController::class, 'manipulation'])->name('manipulation-list');
    Route::get('/class/manipulation/detail', [ClassController::class, 'manipulation_detail'])->name('manipulation-detail');
    Route::get('/class/media', [ClassController::class, 'media'])->name('media-list');
    Route::get('/class/preanswer', [ClassController::class, 'preanswer'])->name('preanswer-list');
    Route::get('/class/translation', [ClassController::class, 'translation'])->name('translation-list');
    
    Route::get('/inter-conncection/in-bound', [InterConnectionController::class, 'inbound'])->name('inboud-list');
    Route::get('/inter-conncection/in-bound/detail', [InterConnectionController::class, 'inbound_detail'])->name('inboud-detail');
    Route::get('/inter-conncection/out-bound', [InterConnectionController::class, 'outbound'])->name('outboud-list');
    Route::get('/inter-conncection/out-bound/detail', [InterConnectionController::class, 'outbound_detail'])->name('outboud-detail');
    
    Route::get('/routing/table', [RoutingController::class, 'table_list'])->name('table-list');
    Route::get('/routing/record', [RoutingController::class, 'record'])->name('record-list');
    
    // ==================================== Enum Route ====================================
    Route::get('/route', [RouteController::class, 'route'])->name('enum-route');
    
    // ==================================== user management Route ====================================
    Route::get('/user-management/user-list', [UserManagementController::class, 'index'])->name('user-manage-user-list');

});

Route::post('/login', [AuthApiController::class, 'Login'])->name('login');

