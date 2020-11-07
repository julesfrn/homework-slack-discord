<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return [
        'jules' => 'fournier',
        'michel' => 'robert'
    ];
});
