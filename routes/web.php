<?php

use Illuminate\Support\Facades\Route;

// Province
Route::get('/', [App\Http\Controllers\ProvinceController::class, 'index'])->name('province.index');

// City
Route::get('city', [App\Http\Controllers\CityController::class, 'index'])->name('city.index');

// Kelurahan
Route::get('kelurahan', [App\Http\Controllers\KelurahanController::class, 'index'])->name('kelurahan.index');

// Kecamatan (Bisa pake resource, tapi saya gapake)
Route::get('kecamatan', [App\Http\Controllers\KecamatanController::class, 'index'])->name('kecamatan.index');
Route::get('kecamatan/{id}/edit', [App\Http\Controllers\KecamatanController::class, 'edit'])->name('kecamatan.edit');
Route::put('kecamatan/{id}', [App\Http\Controllers\KecamatanController::class, 'update'])->name('kecamatan.update');
Route::delete('kecamatan/{id}', [App\Http\Controllers\KecamatanController::class, 'destroy'])->name('kecamatan.hapus');
Route::post('kecamatan/import', [App\Http\Controllers\KecamatanController::class, 'import'])->name('kecamatan.import');
Route::get('kecamatan/export', [App\Http\Controllers\KecamatanController::class, 'export'])->name('kecamatan.export');
