<?php

use ESP\QRCode\Controllers\QRCodeController;

Route::group([
    'middleware' => ['web', 'auth']
], function () {
    Route::group([
        'prefix' => 'qrcode',
        'as' => 'qrcode.'
    ], function () {
        Route::get('/data', [QRCodeController::class, 'data'])->name('data');
        Route::get('/', [QRCodeController::class, 'index'])->name('index');
        Route::post('/', [QRCodeController::class, 'store'])->name('store');
        Route::get('/{qrcode}', [QRCodeController::class, 'edit'])->name('edit');
        Route::post('/{qrcode}', [QRCodeController::class, 'update'])->name('update');
        Route::get('/{qrcode}/destroy', [QRCodeController::class, 'destroy'])->name('destroy');
    });
});
