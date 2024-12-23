<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DataRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::post('/profile/approval', [ApprovalController::class, 'store'])->middleware('role:client')->name('profile.approval.store');
    Route::post('/profile/approval', [ApprovalController::class, 'store'])
    ->middleware('role:client') // middleware client
    ->name('profile.approval.store');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //akses dashboard
    Route::get('/dashboard', [Dashboard::class,'index'])->name('dashboard');


        Route::prefix('admin')->name('admin.')->group(function(){
        Route::put('/approvals/{id}/verify', [ApprovalController::class, 'verify'])->name('approvals.verify');

        
        // Route khusus untuk upload, hanya bisa diakses oleh owner dan admin
        Route::get('data_requests/{dataRequest}/upload', [DataRequestController::class, 'upload'])
            ->name('data_requests.upload')
            ->middleware('role:owner|admin');

        // Route tambahan untuk proses upload (POST request)
        Route::post('data_requests/{dataRequest}/upload', [DataRequestController::class, 'handleUpload'])
            ->name('data_requests.handleUpload')
            ->middleware('role:owner|admin');

        Route::get('data_requests/{dataRequest}/edit', [DataRequestController::class, 'edit'])
        ->name('data_requests.edit')
        ->middleware('role:owner|admin');    

        Route::resource('data_requests', DataRequestController::class)
        ->middleware('role:owner|admin|client');

        Route::resource('surveys', SurveyController::class)
        ->middleware('role:owner|admin|client');

        Route::resource('admins', AdminController::class)
        ->middleware('role:owner');

        Route::resource('approvals', ApprovalController::class)
        ->except(['store'])
        ->middleware('role:owner|admin');


    });

});

require __DIR__.'/auth.php';
