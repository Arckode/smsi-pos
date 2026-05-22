<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BatchController;
use App\Http\Controllers\Api\BatchStatusController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\EdocController;
use App\Http\Controllers\Api\EdocDetailController;
use App\Http\Controllers\Api\EdocStatusController;
use App\Http\Controllers\Api\QrController;

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserListController;
use App\Http\Controllers\Api\UserAccessController;
use App\Http\Controllers\Api\UnitController;
use App\Http\Controllers\Api\UserRolesController;
use App\Http\Controllers\Api\AffiliasiController;
use App\Http\Controllers\Api\NasabahController;






use App\Http\Controllers\Api\AngsuranPinjamanController;
use App\Http\Controllers\Api\AngsuranPembayaranController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\AssetsController;
use App\Http\Controllers\Api\PenghasilanController;
use App\Http\Controllers\Api\ImportController;
use App\Models\Penghasilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->load('unit');
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::prefix('/public')->group(function () {
    Route::get('/qr/{number}', [QrController::class, 'showByQr']);
    Route::post('/batches', [BatchController::class, 'store']);
    Route::put('/batches/{number}', [BatchController::class, 'update']);
    Route::get('/edocs/received-by-bod/list', [EdocController::class, 'receivedByBod']);
    Route::post('/edoc/status/{id}', [EdocController::class, 'updateEdocStatus']);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/current-user', [AuthController::class, 'currentUser']);
    Route::post('/change/users-access', [UserAccessController::class, 'saveAccessChanges']);
    Route::apiResource('/users/access', UserAccessController::class);
    
    Route::post('/change/status/{id}', [UserListController::class, 'changeStatus']);
    Route::post('/reset-password/{id}', [UserListController::class, 'resetPassword']);
    Route::put('/users/{id}', [UserListController::class, 'update']);
    Route::apiResource('/users', UserListController::class);

    Route::get('/affiliasi/options', [AffiliasiController::class, 'options']);
    Route::apiResource('/affiliasi', AffiliasiController::class);

    Route::get('/role/options', [UserRolesController::class, 'options']);
    Route::get('/unit/options', [UnitController::class, 'options']);

    Route::get('/nasabah/options', [NasabahController::class, 'options']);
    Route::get('/nasabah/unvalidated', [NasabahController::class, 'unvalidated']);
    Route::get('/nasabah/drafted', [NasabahController::class, 'drafted']);
    Route::post('/nasabah/validation/{id}/{affiliasiId}', [NasabahController::class, 'validation']);
    Route::get('/preview-pdf/{id}', [NasabahController::class, 'downloadPreviewPdf']);
    Route::get('/preview/{id}', [NasabahController::class, 'showPreview']);
    Route::get('/asuransi/{id}', [NasabahController::class, 'showAsuransi']);
    Route::post('/nasabah/upload', [NasabahController::class, 'upload']);
    Route::post('/nasabah/{id}/send-pengajuan', [NasabahController::class, 'sendPengajuan']);

    Route::apiResource('/nasabah', NasabahController::class);
// ----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------------------

    Route::get('/user/options', [UserController::class, 'options']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    Route::get('/unit/options', [UnitController::class, 'options']);

    Route::post('/simulation', [AngsuranPinjamanController::class, 'scheduleSimulation']);
    Route::post('/angsuran-pinjaman/{id}', [AngsuranPinjamanController::class, 'store']);
    Route::get('/pinjaman-list/{id}', [AngsuranPinjamanController::class, 'pinjamanByNasabah']);
    Route::get('/angsuran-pinjaman/tunggakan', [AngsuranPinjamanController::class, 'listTunggakan']);
    Route::apiResource('/angsuran-pinjaman', AngsuranPinjamanController::class);
    
    Route::get('/angsuran-pembayaran/options', [AngsuranPembayaranController::class, 'options']);
    Route::apiResource('/angsuran-pembayaran', AngsuranPembayaranController::class);

    Route::get('/assets/options', [AssetsController::class, 'options']);
    Route::get('/assets/table/{month}/{year}', [AssetsController::class, 'tables']);
    Route::get('/assets/history/{asset_type}/{month}/{year}', [AssetsController::class, 'history']);
    Route::apiResource('/assets', AssetsController::class);

    Route::get('/penghasilan/options', [PenghasilanController::class, 'options']);
    Route::get('/penghasilan/table/{month}/{year}', [PenghasilanController::class, 'tables']);
    Route::get('/penghasilan/history/{asset_type}/{month}/{year}', [PenghasilanController::class, 'history']);
    Route::apiResource('/penghasilan', PenghasilanController::class);

    Route::get('/report/hasil-usaha', [ReportController::class, 'hasilUsaha']);
    Route::apiResource('/report', ReportController::class);
    
    Route::post('/data/import/verify', [ImportController::class, 'verifyData']);
    Route::post('/data/import/single', [ImportController::class, 'importSingleData']);

// ----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------------------

    Route::get('/edoc/status/options', [EdocStatusController::class, 'edocStatusOptions']);
    Route::post('/edoc/status/{id}', [EdocController::class, 'updateEdocStatus']);
    Route::get('/edoc/category/options', [EdocController::class, 'edocCategoryOptions']);
    Route::get('/edoc/label/options', [EdocController::class, 'edocLabelOptions']);

    Route::get('/edoc/detail/download-file/{edocDetail}', [EdocDetailController::class, 'downloadFile']);

    Route::put('/users/{user}', [UserController::class, 'update']);

    Route::middleware('user')->group(function () {
        Route::get('/edoc/generate-unique-id', [EdocController::class, 'generateEdocId']);
        Route::middleware('edoc.access')->group(function () {
            Route::apiResource('/edocs', EdocController::class);
        });
    });

    Route::get('/edoc/{number}', [EdocController::class, 'showByQr']);

    Route::post('/batch/shipment-number/{id}', [BatchController::class, 'storeShipmentNumber']);

    Route::middleware('secretary')->group(function () {
        Route::apiResource('/dashboard', DashboardController::class);
        Route::get('/secretary/edocs/available', [EdocController::class, 'availableEdocs']);
        Route::get('/secretary/edocs', [EdocController::class, 'index']);
        Route::put('/secretary/edocs/{edoc}', [EdocController::class, 'update']);
        Route::get('/secretary/edocs/{edoc}', [EdocController::class, 'show']);
        Route::get('/batch/status/options', [BatchStatusController::class, 'batchStatusOptions']);
        Route::apiResource('/batches', BatchController::class);

        Route::get('/secretary/unit/options', [UnitController::class, 'options']);

        Route::put('/secretary/users/activate/{users}', [UserController::class, 'activate']);
        Route::apiResource('/secretary/users', UserController::class);

        Route::get('/secretary/users/load/{unit}', [UserController::class, 'loadUser']);
    });
});
