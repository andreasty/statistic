<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dataTunggalController;
use Illuminate\Support\Facades\Route;

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


Route::resource('dataTunggal', dataTunggalController::class);





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::controller(dataTunggalController::class)->group(function () {
    Route::get('dataTunggal', 'index');
    Route::get('dataExport', 'export')->name('dataTunggal.export');
    Route::post('dataImport', 'import')->name('dataTunggal.import');
});

require __DIR__.'/auth.php';
