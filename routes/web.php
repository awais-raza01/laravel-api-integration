<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\ApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category', function () {
    return view('category');
});
Route::get('/category/show', [ApiController::class, 'index'])->name('category.show');
Route::post('/category/store', [ApiController::class, 'store'])->name('category.store');
Route::post('/category/edit/{id}', [ApiController::class, 'edit'])->name('category.edit');
Route::delete('/category/{id}', [ApiController::class, 'destroy'])->name('category.destroy');

