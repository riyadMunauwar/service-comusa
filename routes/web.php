<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', \App\Livewire\Pages\Home::class)->name('home');
Route::get('/c/{category_slug}/{id}', \App\Livewire\Pages\Archieve::class)->name('archieve');
Route::get('/s/{service_slug}/{id}', \App\Livewire\Pages\Single::class)->name('service');
