<?php

use App\Http\Controllers\RestTestController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('rest', RestTestController::class)->names('restTest');
