<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TestimonialController;

// USER AUTHENTICATION
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/TokenSession', [AuthController::class, 'TokenSession']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
});

// CONTACT FORM
Route::post('/contact', [ContactController::class, 'store']);

Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/contacts/{contact}', [ContactController::class, 'show']);
Route::patch('/contacts/{contact}/status/{status}', [ContactController::class, 'updateStatus']);
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy']);

// ROOMS
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::post('/rooms', [RoomController::class, 'store']);

// TESTIMONIALS
Route::get('/testimonials', [TestimonialController::class, 'index']);
