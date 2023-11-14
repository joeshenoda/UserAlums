<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ImageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum',  config('jetstream.auth_session'), 'verified',])->name('dashboard.')->group(function () {

    Route::get('/', [AlbumController::class, 'myAlbums'])->name('myalbums');

    Route::get('/albums', [AlbumController::class, 'allAlbums'])->name('albums');
    Route::prefix('/album')->name('album.')->group(function () {
        Route::post('/', [AlbumController::class, 'store'])->name('store');
        Route::get('/{album}', [AlbumController::class, 'show'])->name('show');
        Route::get('/{album}/edit', [AlbumController::class, 'edit'])->name('edit');
        Route::post('/{album}/update', [AlbumController::class, 'update'])->name('update');
        Route::delete('/{album}/delete', [AlbumController::class, 'destroy'])->name('destroy');
        Route::delete('/{album}/images/delete', [AlbumController::class, 'destroyImages'])->name('images.destroy');
        Route::delete('/{album}/images/asign', [AlbumController::class, 'asignAll'])->name('images.asign');

    });

    Route::prefix('/image')->name('image.')->group(function () {
        Route::post('/store', [ImageController::class, 'store'])->name('store');
        Route::get('/{image}/show', [ImageController::class, 'show'])->name('show');
        Route::delete('{image}/delete', [ImageController::class, 'destroy'])->name('destroy');
        Route::post('{image}/asign', [ImageController::class, 'asign'])->name('asign');

     });


    
});
