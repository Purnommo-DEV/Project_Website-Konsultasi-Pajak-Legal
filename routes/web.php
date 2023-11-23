<?php

use App\Http\Controllers\Admin\Admin_DashboardController;
use App\Http\Controllers\Admin\Admin_PaketBundlingPajakController;
use App\Http\Controllers\Admin\Admin_PaketNotarisController;
use App\Http\Controllers\Admin\Admin_PaketPajakController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Front\Front_BerandaController;
use App\Http\Controllers\Front\Front_RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Front_BerandaController::class, 'halaman_beranda'])->name('HalamanBeranda');

Route::middleware(['guest'])->group(function () {
    Route::controller(Front_RegisterController::class)->group(function () {
        Route::get('register', 'halaman_register')->name('HalamanRegister');
        Route::post('/proses-register', 'proses_register')->name('ProsesRegister');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'halaman_login')->name('HalamanLogin');
        Route::post('/proses-login', 'autentikasi')->name('ProsesLogin');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user-logout', [LoginController::class, 'logout'])->name('LogoutPengguna');

    Route::prefix('admin')->name('admin.')->middleware(['isAdmin'])->group(function () {
        Route::controller(Admin_DashboardController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('HalamanDashboard');
        });

        Route::controller(Admin_PaketPajakController::class)->group(function () {
            Route::get('/paket-pajak', 'halaman_paket_pajak')->name('DataMaster.PaketPajak');
            Route::post('/tambah-paket-pajak', 'tambah_paket_pajak')->name('TambahDataPaketPajak');
            Route::any('/data-paket-pajak', 'data_paket_pajak')->name('DataPaketPajak');
            Route::get('/tampil-data-paket-pajak/{paket_pakjak_id}', 'tampil_data_paket_pajak');
            Route::post('/proses-edit-paket-pajak', 'proses_edit_data_paket_pajak')->name('ProsesEditPaketPajak');
            Route::get('/hapus-data-paket-pajak/{paket_pakjak_id}', 'hapus_data_paket_pajak');
        });

        Route::controller(Admin_PaketBundlingPajakController::class)->group(function () {
            Route::get('/paket-bundling-pajak', 'halaman_paket_bundling_pajak')->name('DataMaster.PaketBundlingPajak');
            Route::post('/tambah-paket-bundling-pajak', 'tambah_paket_bundling_pajak')->name('TambahDataPaketBundlingPajak');
            Route::any('/data-paket-bundling-pajak', 'data_paket_bundling_pajak')->name('DataPaketBundlingPajak');
            Route::get('/tampil-data-paket-bundling-pajak/{paket_pakjak_id}', 'tampil_data_paket_bundling_pajak');
            Route::post('/proses-edit-paket-bundling-pajak', 'proses_edit_data_paket_bundling_pajak')->name('ProsesEditPaketBundlingPajak');
            Route::get('/hapus-data-paket-bundling-pajak/{paket_pakjak_id}', 'hapus_data_paket_bundling_pajak');

            Route::get('/detail-paket-bundling-pajak/{slug}', 'halaman_detail_paket_bundling_pajak')->name('DataMaster.PaketBundlingPajak.DetailPaketBundlingPajak');
            Route::post('/proses-tambah-jenis-pb-pajak', 'proses_tambah_jenis_pb_pajak')->name('ProsesTambahJenisPBPajak_Child1');
            Route::post('/proses-tambah-sub-jenis-pb-pajak-child2', 'proses_tambah_sub_jenis_pb_pajak_child2')->name('ProsesTambahSubJenisPBPajak_Child2');
            Route::post('/proses-tambah-sub-jenis-pb-pajak-child3', 'proses_tambah_sub_jenis_pb_pajak_child3')->name('ProsesTambahSubJenisPBPajak_Child3');

            Route::get('/hapus-data-paket-bundling-pajak-child1/{pb_child1_id}', 'hapus_data_paket_bundling_pajak_child_1');
            Route::get('/tampil-data-paket-bundling-pajak-child1/{pb_child1_id}', 'tampil_data_paket_bundling_pajak_child1');
            Route::post('/proses-edit-paket-bundling-pajak-child1', 'proses_edit_data_paket_bundling_pajak_child1')->name('ProsesEditPaketBundlingPajak_Child1');

            Route::get('/tampil-data-paket-bundling-pajak-child2/{pb_child2_id}', 'tampil_data_paket_bundling_pajak_child2');
            Route::post('/proses-edit-paket-bundling-pajak-child2', 'proses_edit_data_paket_bundling_pajak_child2')->name('ProsesEditPaketBundlingPajak_Child2');
            Route::get('/hapus-data-paket-bundling-pajak-child2/{pb_child2_id}', 'hapus_data_paket_bundling_pajak_child2');

            Route::get('/tampil-data-paket-bundling-pajak-child3/{pb_child3_id}', 'tampil_data_paket_bundling_pajak_child3');
            Route::post('/proses-edit-paket-bundling-pajak-child3', 'proses_edit_data_paket_bundling_pajak_child3')->name('ProsesEditPaketBundlingPajak_Child3');
            Route::get('/hapus-data-paket-bundling-pajak-child3/{pb_child3_id}', 'hapus_data_paket_bundling_pajak_child3');
        });

        Route::controller(Admin_PaketNotarisController::class)->group(function () {
            Route::get('/paket-pelayanan-notaris', 'halaman_paket_pelayanan_notaris')->name('DataMaster.PaketPelayananNotaris');
            Route::post('/tambah-paket-pelayanan-notaris', 'tambah_paket_pelayanan_notaris')->name('TambahDataPaketPelayananNotaris');
            Route::any('/data-paket-pelayanan-notaris', 'data_paket_pelayanan_notaris')->name('DataPaketPelayananNotaris');
            Route::get('/tampil-data-paket-pelayanan-notaris/{paket_pakjak_id}', 'tampil_data_paket_pelayanan_notaris');
            Route::post('/proses-edit-paket-pelayanan-notaris', 'proses_edit_data_paket_pelayanan_notaris')->name('ProsesEditPaketPelayananNotaris');
            Route::get('/hapus-data-paket-pelayanan-notaris/{paket_pakjak_id}', 'hapus_data_paket_pelayanan_notaris');

            Route::get('/detail-paket-pelayanan-notaris/{slug}', 'halaman_detail_paket_pelayanan_notaris')->name('DataMaster.PaketPelayananNotaris.DetailPaketPelayananNotaris');
        });
    });

    Route::prefix('client')->name('client.')->middleware(['isClient'])->group(function () {
        // Route::controller(Front_DetailProgramController::class)->group(function () {
        //     Route::post('/tambah-ke-daftar-pilihan', 'tambah_ke_daftar_pilihan')->name('TambahKeDaftarPilihan');
        // });
    });
});
