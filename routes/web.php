<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/table', function () {
    return view('input');
});

Route::get('/input', function () {
    return view('input'); // Ini akan memanggil file 'input.blade.php'
});
