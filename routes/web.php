<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PesansController;
use App\Http\Controllers\RiwayatPesansController;
use App\Http\Controllers\IbusController;
use App\Http\Controllers\WilayahKerjasController;
use App\Http\Controllers\AnaksController;
use App\Http\Controllers\JadwalImunisasisController;
use App\Http\Controllers\JenisImunisasisController;
use App\Http\Controllers\UsersWilayahsController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

Route::group([
    'prefix' => 'pesans',
], function () {
    Route::get('/', [PesansController::class, 'index'])
         ->name('pesans.pesans.index');
    Route::get('/create', [PesansController::class, 'create'])
         ->name('pesans.pesans.create');
    Route::get('/show/{pesans}',[PesansController::class, 'show'])
         ->name('pesans.pesans.show');
    Route::get('/{pesans}/edit',[PesansController::class, 'edit'])
         ->name('pesans.pesans.edit');
    Route::post('/', [PesansController::class, 'store'])
         ->name('pesans.pesans.store');
    Route::put('pesans/{pesans}', [PesansController::class, 'update'])
         ->name('pesans.pesans.update');
    Route::delete('/pesans/{pesans}',[PesansController::class, 'destroy'])
         ->name('pesans.pesans.destroy');
});

Route::group([
    'prefix' => 'riwayat_pesans',
], function () {
    Route::get('/', [RiwayatPesansController::class, 'index'])
         ->name('riwayat_pesans.riwayat_pesans.index');
    Route::get('/create', [RiwayatPesansController::class, 'create'])
         ->name('riwayat_pesans.riwayat_pesans.create');
    Route::get('/show/{riwayatPesans}',[RiwayatPesansController::class, 'show'])
         ->name('riwayat_pesans.riwayat_pesans.show');
    Route::get('/{riwayatPesans}/edit',[RiwayatPesansController::class, 'edit'])
         ->name('riwayat_pesans.riwayat_pesans.edit');
    Route::post('/', [RiwayatPesansController::class, 'store'])
         ->name('riwayat_pesans.riwayat_pesans.store');
    Route::put('riwayat_pesans/{riwayatPesans}', [RiwayatPesansController::class, 'update'])
         ->name('riwayat_pesans.riwayat_pesans.update');
    Route::delete('/riwayat_pesans/{riwayatPesans}',[RiwayatPesansController::class, 'destroy'])
         ->name('riwayat_pesans.riwayat_pesans.destroy');
});

Route::group([
    'prefix' => 'ibus',
], function () {
    Route::get('/', [IbusController::class, 'index'])
         ->name('ibus.ibu.index');
    Route::get('/create', [IbusController::class, 'create'])
         ->name('ibus.ibu.create');
    Route::get('/show/{ibu}',[IbusController::class, 'show'])
         ->name('ibus.ibu.show');
    Route::get('/{ibu}/edit',[IbusController::class, 'edit'])
         ->name('ibus.ibu.edit');
    Route::post('/', [IbusController::class, 'store'])
         ->name('ibus.ibu.store');
    Route::put('ibu/{ibu}', [IbusController::class, 'update'])
         ->name('ibus.ibu.update');
    Route::delete('/ibu/{ibu}',[IbusController::class, 'destroy'])
         ->name('ibus.ibu.destroy');
});

Route::group([
    'prefix' => 'wilayah_kerjas',
], function () {
    Route::get('/', [WilayahKerjasController::class, 'index'])
         ->name('wilayah_kerjas.wilayah_kerja.index');
    Route::get('/create', [WilayahKerjasController::class, 'create'])
         ->name('wilayah_kerjas.wilayah_kerja.create');
    Route::get('/show/{wilayahKerja}',[WilayahKerjasController::class, 'show'])
         ->name('wilayah_kerjas.wilayah_kerja.show');
    Route::get('/{wilayahKerja}/edit',[WilayahKerjasController::class, 'edit'])
         ->name('wilayah_kerjas.wilayah_kerja.edit');
    Route::post('/', [WilayahKerjasController::class, 'store'])
         ->name('wilayah_kerjas.wilayah_kerja.store');
    Route::put('wilayah_kerja/{wilayahKerja}', [WilayahKerjasController::class, 'update'])
         ->name('wilayah_kerjas.wilayah_kerja.update');
    Route::delete('/wilayah_kerja/{wilayahKerja}',[WilayahKerjasController::class, 'destroy'])
         ->name('wilayah_kerjas.wilayah_kerja.destroy');
});

Route::group([
    'prefix' => 'anaks',
], function () {
    Route::get('/', [AnaksController::class, 'index'])
         ->name('anaks.anak.index');
    Route::get('/create', [AnaksController::class, 'create'])
         ->name('anaks.anak.create');
    Route::get('/show/{anak}',[AnaksController::class, 'show'])
         ->name('anaks.anak.show');
    Route::get('/{anak}/edit',[AnaksController::class, 'edit'])
         ->name('anaks.anak.edit');
    Route::post('/', [AnaksController::class, 'store'])
         ->name('anaks.anak.store');
    Route::put('anak/{anak}', [AnaksController::class, 'update'])
         ->name('anaks.anak.update');
    Route::delete('/anak/{anak}',[AnaksController::class, 'destroy'])
         ->name('anaks.anak.destroy');
});

Route::group([
    'prefix' => 'jadwal_imunisasis',
], function () {
    Route::get('/', [JadwalImunisasisController::class, 'index'])
         ->name('jadwal_imunisasis.jadwal_imunisasi.index');
    Route::get('/create', [JadwalImunisasisController::class, 'create'])
         ->name('jadwal_imunisasis.jadwal_imunisasi.create');
    Route::get('/show/{jadwalImunisasi}',[JadwalImunisasisController::class, 'show'])
         ->name('jadwal_imunisasis.jadwal_imunisasi.show');
    Route::get('/{jadwalImunisasi}/edit',[JadwalImunisasisController::class, 'edit'])
         ->name('jadwal_imunisasis.jadwal_imunisasi.edit');
    Route::post('/', [JadwalImunisasisController::class, 'store'])
         ->name('jadwal_imunisasis.jadwal_imunisasi.store');
    Route::put('jadwal_imunisasi/{jadwalImunisasi}', [JadwalImunisasisController::class, 'update'])
         ->name('jadwal_imunisasis.jadwal_imunisasi.update');
    Route::delete('/jadwal_imunisasi/{jadwalImunisasi}',[JadwalImunisasisController::class, 'destroy'])
         ->name('jadwal_imunisasis.jadwal_imunisasi.destroy');
});

Route::group([
    'prefix' => 'jenis_imunisasis',
], function () {
    Route::get('/', [JenisImunisasisController::class, 'index'])
         ->name('jenis_imunisasis.jenis_imunisasi.index');
    Route::get('/create', [JenisImunisasisController::class, 'create'])
         ->name('jenis_imunisasis.jenis_imunisasi.create');
    Route::get('/show/{jenisImunisasi}',[JenisImunisasisController::class, 'show'])
         ->name('jenis_imunisasis.jenis_imunisasi.show');
    Route::get('/{jenisImunisasi}/edit',[JenisImunisasisController::class, 'edit'])
         ->name('jenis_imunisasis.jenis_imunisasi.edit');
    Route::post('/', [JenisImunisasisController::class, 'store'])
         ->name('jenis_imunisasis.jenis_imunisasi.store');
    Route::put('jenis_imunisasi/{jenisImunisasi}', [JenisImunisasisController::class, 'update'])
         ->name('jenis_imunisasis.jenis_imunisasi.update');
    Route::delete('/jenis_imunisasi/{jenisImunisasi}',[JenisImunisasisController::class, 'destroy'])
         ->name('jenis_imunisasis.jenis_imunisasi.destroy');
});

Route::group([
    'prefix' => 'wilayah_kerjas',
], function () {
    Route::get('/', [WilayahKerjasController::class, 'index'])
         ->name('wilayah_kerjas.wilayah_kerjas.index');
    Route::get('/create', [WilayahKerjasController::class, 'create'])
         ->name('wilayah_kerjas.wilayah_kerjas.create');
    Route::get('/show/{wilayahKerjas}',[WilayahKerjasController::class, 'show'])
         ->name('wilayah_kerjas.wilayah_kerjas.show');
    Route::get('/{wilayahKerjas}/edit',[WilayahKerjasController::class, 'edit'])
         ->name('wilayah_kerjas.wilayah_kerjas.edit');
    Route::post('/', [WilayahKerjasController::class, 'store'])
         ->name('wilayah_kerjas.wilayah_kerjas.store');
    Route::put('wilayah_kerjas/{wilayahKerjas}', [WilayahKerjasController::class, 'update'])
         ->name('wilayah_kerjas.wilayah_kerjas.update');
    Route::delete('/wilayah_kerjas/{wilayahKerjas}',[WilayahKerjasController::class, 'destroy'])
         ->name('wilayah_kerjas.wilayah_kerjas.destroy');
});

Route::group([
    'prefix' => 'users_wilayahs',
], function () {
    Route::get('/', [UsersWilayahsController::class, 'index'])
         ->name('users_wilayahs.users_wilayahs.index');
    Route::get('/create', [UsersWilayahsController::class, 'create'])
         ->name('users_wilayahs.users_wilayahs.create');
    Route::get('/show/{usersWilayahs}',[UsersWilayahsController::class, 'show'])
         ->name('users_wilayahs.users_wilayahs.show');
    Route::get('/{usersWilayahs}/edit',[UsersWilayahsController::class, 'edit'])
         ->name('users_wilayahs.users_wilayahs.edit');
    Route::post('/', [UsersWilayahsController::class, 'store'])
         ->name('users_wilayahs.users_wilayahs.store');
    Route::put('users_wilayahs/{usersWilayahs}', [UsersWilayahsController::class, 'update'])
         ->name('users_wilayahs.users_wilayahs.update');
    Route::delete('/users_wilayahs/{usersWilayahs}',[UsersWilayahsController::class, 'destroy'])
         ->name('users_wilayahs.users_wilayahs.destroy');
});
