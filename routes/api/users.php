<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix("users")->middleware("auth:sanctum")->group(function () {
    Route::get("/index", [UsersController::class,"index"]);

});