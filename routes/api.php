<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['api']], function(){
    Route::get('province', [App\Http\Controllers\ProvinceController::class, 'getAll'])->name('province.getAll');
    Route::get('city/{id}', [App\Http\Controllers\CityController::class, 'getCityByProvinceID'])->name('city.getSingle');
    Route::get('kelurahan/{id}', [App\Http\Controllers\KelurahanController::class, 'getKelurahanByCityID'])->name('kelurahan.getSingle');
    Route::get('kecamatan/{id}', [App\Http\Controllers\KecamatanController::class, 'getKecamatanByKelurahanID'])->name('kecamatan.getSingle');
});
