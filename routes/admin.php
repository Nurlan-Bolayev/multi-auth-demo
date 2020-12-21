<?php

use App\Http\Controllers\AdminController;


Route::post('/login', AdminController::class . '@loginAdmin');

