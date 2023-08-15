<?php

use Modules\Customer\Http\Controllers\CustomerController;
use Modules\Customer\Http\Controllers\AddressController;

// temporaria middleware para testcase - mudar para auth
use Modules\Customer\Http\Middleware\AuthTemp;

Route::prefix('customer')->group(function () {
    Route::post('register', [CustomerController::class, 'register'])->name('customer.register');
    Route::post('authenticate', [CustomerController::class, 'authenticate'])->name('customer.authenticate');

    // temporaria middleware para testcase - mudar para auth
    Route::group(['middleware' => AuthTemp::class], function () {
        Route::put('update', [CustomerController::class, 'update'])->name('customer.update');
        Route::put('changePassword', [CustomerController::class, 'chagePassword'])->name('customer.change-password');
    
        Route::prefix('address')->group(function () {
            Route::post('', [AddressController::class, 'create'])->name('customer.address.create');
            Route::put('', [AddressController::class, 'update'])->name('customer.address.update');
            Route::get('', [AddressController::class, 'get'])->name('customer.address.get');
        });

        Route::get('logout', [CustomerController::class, 'logout'])->name('customer.logout');
    });
});
