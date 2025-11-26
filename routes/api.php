<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ContactController;

// Test route
Route::get('/test', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is working!',
        'timestamp' => now()->toISOString(),
    ]);
});

// Contact form submission - MUST be POST
Route::post('/contact', [ContactController::class, 'store']);

// Admin routes (optional, for viewing contacts)
Route::get('/contacts', [ContactController::class, 'index']);
Route::get('/contacts/{contact}', [ContactController::class, 'show']);
Route::patch('/contacts/{contact}/status/{status}', [ContactController::class, 'updateStatus']);
Route::delete('/contacts/{contact}', [ContactController::class, 'destroy']);