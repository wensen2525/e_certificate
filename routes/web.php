<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BOM30thController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ParticipantController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [BOM30thController::class,'index'])->name('index');

Route::prefix('participants')->name('participants.')->group(function () {
    Route::get('export', [ParticipantController::class, 'export'])->name('export');
    Route::post('import', [ParticipantController::class, 'import'])->name('import');
    Route::get('delete-all', [ParticipantController::class, 'deleteAll'])->name('delete-all');
});
Route::resource('participants', ParticipantController::class);

Route::prefix('boms')->name('boms.')->group(function () {
    Route::get('export', [BOM30thController::class, 'export'])->name('export');
    Route::post('import', [BOM30thController::class, 'import'])->name('import');
    Route::get('delete-all', [BOM30thController::class, 'deleteAll'])->name('delete-all');
    Route::get('make-hash', [BOM30thController::class, 'makeHash'])->name('make-hash');
    Route::get('make-password', [BOM30thController::class, 'makePassword'])->name('make-password');
});
Route::resource('boms', BOM30thController::class);

Route::prefix('ceritificates')->name('ceritificates.')->group(function () {
    Route::get('{participant}/save', [CertificateController::class, 'save'])->name('save');
    Route::get('{participant}/download', [CertificateController::class, 'download'])->name('download');
    Route::get('{participant}/send', [CertificateController::class, 'send'])->name('send');
    Route::get('viewpdf', [CertificateController::class, 'viewpdf'])->name('viewpdf');
    Route::get('{scale}/download-all-certificates', [CertificateController::class, 'downloadAllCertificates'])->name('download-all-certificates');
    Route::get('{scale}/send-all-certificates', [CertificateController::class, 'sendAllCertificates'])->name('send-all-certificates');
});
Route::resource('ceritificates', CertificateController::class);