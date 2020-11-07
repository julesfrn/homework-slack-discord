<?php

use Illuminate\Support\Facades\Route;

/* 
|---------- DON'T ADD OTHER ROUTES HERE ----------|
| Web routes will be handled by the vue-router    |
| To add api routes go to the api router          |
|-------------------------------------------------|
*/

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
