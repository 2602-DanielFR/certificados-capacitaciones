<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicCourseController;

Route::get('/', [
    PublicCourseController::class,
    'index',
])->name('home');

Route::get('/capacitaciones/{course}', [
    PublicCourseController::class,
    'show',
])->name('courses.show');

Route::post('/capacitaciones/{course}/inscripcion', [
    PublicCourseController::class,
    'store',
])->name('courses.register');
Route::get(
    '/certificados/consulta/{lookupToken}',
    [PublicCourseController::class, 'certificateStatus']
)->name('certificates.status');

Route::get(
    '/certificados/descargar/{lookupToken}',
    [PublicCourseController::class, 'downloadCertificate']
)->name('certificates.download');

Route::get(
    '/verificar-certificado',
    [PublicCourseController::class, 'verificationForm']
)->name('certificates.verify.form');

Route::post(
    '/verificar-certificado',
    [PublicCourseController::class, 'verifyCertificate']
)->name('certificates.verify');