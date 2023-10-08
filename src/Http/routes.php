<?php

use Packagit\Dcat\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::resource('/config', Controllers\ConfigController::class);
