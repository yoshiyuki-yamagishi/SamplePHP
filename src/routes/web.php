<?php

use App\Models\UserAddress;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;

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

Route::get('Linux1', function () {
    return view('index');
});
Route::get('LinuxForm', function () {
    return view('form2');
});

Route::get('', [IndexController::class, 'index'])->name('index');
Route::post('form', [IndexController::class, 'form'])->name('form');
//追加
Route::get('LinuxData', [IndexController::class, 'dataList'])->name('dataList');
//編集ページroute追加
Route::post('LinuxDataEdit', [IndexController::class, 'getDataEdit'])->name('getDataEdit');
Route::post('LinuxDataUpdate', [IndexController::class, 'updateData'])->name('updateData');




