<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListItemController;
use App\Http\Controllers\AddItemController;
use App\Http\Controllers\DeleteItemController;
use App\Http\Controllers\EditItemController;
use App\Http\Controllers\MainItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/items", [ListItemController::class, "index"]);
Route::prefix("/item")->group(function () {
    Route::post("/store", [AddItemController::class, "store"]);
    Route::put("/{id}", [EditItemController::class, "update"]);
    Route::delete("/{id}", [DeleteItemController::class, "destroy"]);
});
