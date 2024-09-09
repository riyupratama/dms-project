<?php

use App\Http\Controllers\FolderController;
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

Route::get('/', function () {
    return view('welcome', [
        'products' => App\Models\Product::all()
    ]);
});

Route::group(['prefix' => 'folders'], function () {
    Route::group(['prefix' => 'create'], function () {
        Route::get('{parent_id?}', [FolderController::class, 'create'])->name('folder.create');
        Route::post('{parent_id?}', [FolderController::class, 'store'])->name('folder.store');
    });
    Route::get('{id?}', [FolderController::class, 'index'])->name('folders');
});
