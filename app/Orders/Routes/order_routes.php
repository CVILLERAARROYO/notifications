<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/orders', function (Request $request) {
    return $request->all();
});
