<?php

use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ParticipantController::class,'index'])->name('index');

Route::prefix('participants')->name('participants.')->group(function () {
    Route::get('export', [ParticipantController::class, 'export'])->name('export');
    Route::post('import', [ParticipantController::class, 'import'])->name('import');
    Route::get('delete-all', [ParticipantController::class, 'deleteAll'])->name('delete-all');
});
Route::resource('participants', ParticipantController::class);

Route::prefix('ceritificates')->name('ceritificates.')->group(function () {
    Route::get('{participant}/save', [CertificateController::class, 'save'])->name('save');
    Route::get('{participant}/download', [CertificateController::class, 'download'])->name('download');
    Route::get('{participant}/send', [CertificateController::class, 'send'])->name('send');
    Route::get('viewpdf', [CertificateController::class, 'viewpdf'])->name('viewpdf');
    Route::get('{scale}/download-all-certificates', [CertificateController::class, 'downloadAllCertificates'])->name('download-all-certificates');
    Route::get('{scale}/send-all-certificates', [CertificateController::class, 'sendAllCertificates'])->name('send-all-certificates');
});
Route::resource('ceritificates', CertificateController::class);