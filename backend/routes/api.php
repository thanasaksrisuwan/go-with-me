<?php

use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return response()->json(['message' => 'Hello World']);
});
Route::get('/test', function () {
    return response()->json(['message' => 'ok']);
});
Route::post('/login', [LoginController::class, 'login']);
