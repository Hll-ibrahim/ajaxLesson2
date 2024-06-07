<?php

use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $people = \App\Models\Person::all();
    return view('welcome',compact('people'));
});

Route::post('/post',[PersonController::class, 'post'])->name('post');
Route::get('/fetch',[PersonController::class, 'fetch'])->name('fetch');
