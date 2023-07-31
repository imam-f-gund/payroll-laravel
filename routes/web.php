<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataMaster\JabatanController;
use App\Http\Controllers\DataMaster\TambahanController;
use App\Http\Controllers\User\DetailUserController;
use App\Http\Controllers\Gaji\GajiController;
use App\Http\Controllers\Presensi\PresensiController;
use App\Http\Controllers\Approval\ApprovalGajiController;

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
    if (Auth::check()) {
        return to_route('dashboard');
    } else {
        return to_route('login');
    }
});
    
    Route::get('dashboard', function () {
        return view('pages.dashboard');
    })->name('dashboard');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'cek_login'])->name('cek_login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::resource('jabatan', JabatanController::class);
    Route::resource('tambahan', TambahanController::class);
    Route::resource('detailpegawai', DetailUserController::class);
    Route::resource('gaji', GajiController::class);
    Route::resource('presensi', PresensiController::class);
    Route::resource('gaji-approval', ApprovalGajiController::class);
    
    Route::get('print-gaji', function () {
        return view('pages.gaji.print.print');
    })->name('print-gaji');
        
        //semua route dalam grup ini hanya bisa diakses siswa
    // });
    
    
 
