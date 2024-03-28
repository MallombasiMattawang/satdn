<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\ViewFileController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\HistoryServiceController;
use App\Http\Controllers\ProgresDocumentController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CommunitySatisfactionIndexController;

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

// Route::get('/', function () {
//     return view('app');
// });

// Route::view('/{any}', 'app')->where('any', '.*');

//mentenance
// Route::get('/', function () {
//     return view('maintenance');
// });

Route::get('/', [LandingPageController::class, 'index'])->name('landing-page');
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking');
Route::get('/tracking/cari', [TrackingController::class, 'cari'])->name('tracking.cari');

Route::get('/verification', [TrackingController::class, 'verification'])->name('verification');
Route::get('/validasi', [TrackingController::class, 'validasi'])->name('validasi');
Route::post('/validasi/validasi_pdf', [TrackingController::class, 'validasi_pdf'])->name('validasi.validasi_pdf');


Route::get('view-file', [ViewFileController::class, 'index'])->name('view-file');
Route::get('view-file/sk_pdf', [ViewFileController::class, 'sk_pdf'])->name('sk_pdf');
Route::post('/service-page', [LandingPageController::class, 'getServices'])->name('service-page');

Route::get('kirim-email','App\Http\Controllers\MailController@index');

Auth::routes(['verify' => true]);



Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('password', [UserController::class, 'edit'])->name('user.password.edit');
Route::patch('password', [UserController::class, 'update'])->name('user.password.update');
Route::get('history', [HistoryServiceController::class, 'index'])->name('history');
Route::get('getService/{id}', [ProgresDocumentController::class, 'getService'])->name('getService');
Route::post('store-service', [ProgresDocumentController::class, 'storeService'])->name('store-service');
Route::get('getDocument/{id}', [ProgresDocumentController::class, 'getDocument'])->name('getDocument');
Route::post('updateBiodata', [ProgresDocumentController::class, 'updateBiodata'])->name('updateBiodata');
Route::post('uploadDocument', [ProgresDocumentController::class, 'uploadDocument'])->name('uploadDocument');
Route::post('updateToVerified', [ProgresDocumentController::class, 'updateToVerified'])->name('updateToVerified');
Route::get('getVerified/{id}', [ProgresDocumentController::class, 'getVerified'])->name('getVerified');

Route::post('ikm', [CommunitySatisfactionIndexController::class, 'store'])->name('ikm');

Route::get('print', [PrintController::class, 'index'])->name('print');
Route::get('convert', [PrintController::class, 'convert'])->name('convert');

Route::get('api/status_user', [ApiController::class, 'status_user'])->name('status_user');
Route::post('api/signPdf', [ApiController::class, 'signPdf'])->name('signPdf');

Route::get('/reload-captcha', [App\Http\Controllers\Auth\RegisterController::class, 'reloadCaptcha']);
