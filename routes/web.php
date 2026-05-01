<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::view('/homepage', 'homepage');
Route::get('/rental', [\App\Http\Controllers\RentalController::class, 'index'])->name('rental');

// Property API routes (public)
Route::prefix('api')->group(function () {
    Route::get('/properties', [\App\Http\Controllers\RentalController::class, 'properties'])->name('api.properties');
    Route::get('/properties/{property}', [\App\Http\Controllers\RentalController::class, 'show'])->name('api.properties.show');
    Route::get('/properties-map', [\App\Http\Controllers\RentalController::class, 'mapData'])->name('api.properties.map');
});

// Property detail page
Route::get('/property/{id}', function ($id) {
    $property = \App\Models\Property::with(['images', 'landlord'])->find($id);
    
    return view('property-detail', [
        'property' => $property,
        'propertyId' => $id
    ]);
})->name('property.show');

// Chat Routes
Route::prefix('chat')->name('chat.')->group(function () {
    Route::get('/landlord/{landlordId}', [\App\Http\Controllers\ChatController::class, 'landlord'])->name('landlord');
    Route::get('/ai', [\App\Http\Controllers\ChatController::class, 'aiChat'])->name('ai');
    
    // API endpoints for chat (can be used later with AJAX)
    Route::post('/send', [\App\Http\Controllers\ChatController::class, 'sendMessage'])->name('send');
    Route::get('/messages/{landlordId}', [\App\Http\Controllers\ChatController::class, 'getMessages'])->name('messages');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Landlord Routes
    Route::prefix('landlord')->name('landlord.')->group(function () {
        // Verification routes
        Route::get('verification/pending', [\App\Http\Controllers\LandlordVerificationController::class, 'pending'])
            ->name('verification.pending');
        Route::post('verification/upload', [\App\Http\Controllers\LandlordVerificationController::class, 'uploadDocument'])
            ->name('verification.upload');
        Route::get('verification/status', [\App\Http\Controllers\LandlordVerificationController::class, 'checkStatus'])
            ->name('verification.status');
        
        // Property management routes
        Route::resource('properties', \App\Http\Controllers\Landlord\PropertyController::class);
        Route::post('properties/{property}/images/{image}/set-primary', [\App\Http\Controllers\Landlord\PropertyController::class, 'setPrimaryImage'])
            ->name('properties.set-primary-image');
        Route::delete('properties/{property}/images/{image}', [\App\Http\Controllers\Landlord\PropertyController::class, 'deleteImage'])
            ->name('properties.delete-image');
    });
    
    // Tenant Routes
    Route::prefix('tenant')->name('tenant.')->group(function () {
        Route::get('dashboard', [\App\Http\Controllers\Tenant\TenantController::class, 'dashboard'])->name('dashboard');
        Route::get('saved', [\App\Http\Controllers\Tenant\TenantController::class, 'saved'])->name('saved');
        Route::get('rentals', [\App\Http\Controllers\Tenant\TenantController::class, 'rentals'])->name('rentals');
        Route::post('properties/{property}/save', [\App\Http\Controllers\Tenant\TenantController::class, 'saveProperty'])->name('properties.save');
        Route::post('properties/{property}/unsave', [\App\Http\Controllers\Tenant\TenantController::class, 'unsaveProperty'])->name('properties.unsave');
        Route::post('properties/{property}/toggle', [\App\Http\Controllers\Tenant\TenantController::class, 'toggleProperty'])->name('properties.toggle');
    });
    
    // Message Routes (for both users and landlords)
    Route::get('/messages', [\App\Http\Controllers\ChatController::class, 'messageList'])->name('messages.index');
    Route::get('/messages/{recipientId}', [\App\Http\Controllers\ChatController::class, 'chat'])->name('messages.chat');
});

require __DIR__.'/auth.php';
