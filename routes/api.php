<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BookingController;

// USER AUTHENTICATION API ROUTES

// Public routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/TokenSession', [AuthController::class, 'TokenSession']);

// Contact form route (public)
Route::post('/contact', [ContactController::class, 'store']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    
    // Contact management routes (admin only)
    Route::get('/contacts', [ContactController::class, 'index']);
    Route::get('/contacts/{id}', [ContactController::class, 'show']);
    Route::patch('/contacts/{id}/status', [ContactController::class, 'updateStatus']);
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);
});

// CONTACT FORM API ROUTES
Route::post('/contact', [ContactController::class, 'store']);

// Admin routes (optional, for viewing contacts)
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/contacts/{contact}', [ContactController::class, 'show']);
Route::patch('/contacts/{contact}/status/{status}', [ContactController::class, 'updateStatus']);
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy']);

// ROOM AND BOOKING MANAGEMENT API ROUTES
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/rooms/{id}', [RoomController::class, 'show']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index']);
});
    
Route::post('/booking', [BookingController::class, 'store']);

// TESTIMONIALS API ROUTE
Route::get('/testimonials', [TestimonialController::class, 'index']);


