<?php

use Illuminate\Routing\Router;
//use App\Admin\Controllers\ProgresDocumentController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('progres-documents', ProgresDocumentController::class);

    // Allow roles `administrator` and `fo` access the routes under group.
    Route::group([
        'middleware' => 'admin.permission:allow,fo,tim-teknis,bo,kasi,kabid,sekretaris,kadis',
    ], function ($router) {       
        $router->resource('progres-documents', ProgresDocumentController::class);
    });

    // Allow roles `administrator` and `fo` access the routes under group.
    Route::group([
        'middleware' => 'admin.permission:allow,fo',
    ], function ($router) {
        $router->resource('verification', VerificationController::class); 
        $router->resource('report-all-verification', ReportAllVerificationController::class);
        $router->get('generate', 'ReportAllVerificationController@generate')->name('generate');
        
    });

    // Allow roles `administrator` and `fo` access the routes under group.
    Route::group([
        'middleware' => 'admin.permission:allow,tim-teknis',
    ], function ($router) {
        $router->resource('verification-teknis', VerificationTeknisController::class);
       
    });

    // Allow roles `administrator` and `fo` access the routes under group.
    Route::group([
        'middleware' => 'admin.permission:allow,bo',
    ], function ($router) {
        $router->resource('historyTeknis', HistoryController::class);
        $router->get('historyTeknis', 'HistoryController@historyTeknis')->name('historyTeknis');
        $router->get('verifikasi_surat', 'ApprovalController@verifikasi_surat')->name('verifikasi_surat');
        $router->post('kirim_surat', 'ApprovalController@kirim_surat')->name('kirim_surat');
       
    });

    // Allow roles `administrator` and `fo` access the routes under group.
    Route::group([
        'middleware' => 'admin.permission:allow,kasi,kabid,sekretaris,kadis',
    ], function ($router) {
        $router->resource('approval', ApprovalController::class);
        $router->get('approval_1', 'ApprovalController@approval_1')->name('approval_1');
        $router->get('getApproval_1', 'ApprovalController@getApproval_1')->name('getApproval_1');
        
        $router->post('setApproval_1', 'ApprovalController@setApproval_1')->name('setApproval_1');
       
    });

     // Allow roles `administrator` and `fo` access the routes under group.
     Route::group([
        'middleware' => 'admin.permission:allow,administrator',
    ], function ($router) {
        $router->resource('users', UserController::class);
        $router->resource('tags', TagController::class);
        $router->resource('posts', PostController::class);
        $router->resource('services', ServiceController::class);
        $router->resource('service-type', ServiceTypeController::class);
        $router->resource('documents', DocumentController::class);
        $router->resource('service-inputs', ServiceInputController::class);
        $router->resource('log-esigns', LogEsignController::class);
        
        $router->resource('esigns', EsignController::class);
        $router->get('esign_pdf', 'EsignController@esign_pdf')->name('esign_pdf');
        $router->get('verify_pdf', 'EsignController@verify_pdf')->name('verify_pdf');
        $router->get('verify_user', 'EsignController@verify_user')->name('verify_user');
        $router->get('regis_user', 'EsignController@regis_user')->name('regis_user');

        $router->post('send_esign_pdf', 'EsignController@send_esign_pdf')->name('send_esign_pdf');
        $router->post('send_verify_pdf', 'EsignController@send_verify_pdf')->name('send_verify_pdf');
        $router->post('send_verify_user', 'EsignController@send_verify_user')->name('send_verify_user');
        $router->post('send_regis_user', 'EsignController@send_regis_user')->name('send_regis_user');
       
    });
});
