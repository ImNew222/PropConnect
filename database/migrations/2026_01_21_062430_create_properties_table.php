<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('landlord_id')->constrained('users')->onDelete('cascade');
            
            // Basic info
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('property_type', ['studio', 'condo', 'apartment', 'house', 'hotel', 'room'])->default('apartment');
            
            // Pricing
            $table->decimal('price', 10, 2); // Monthly rent
            $table->decimal('deposit', 10, 2)->nullable();
            
            // Specs
            $table->integer('bedrooms')->default(1);
            $table->integer('bathrooms')->default(1);
            $table->decimal('floor_area', 8, 2)->nullable(); // sqm
            $table->integer('floor_number')->nullable();
            
            // Location
            $table->string('address');
            $table->string('city')->default('Cebu City');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            // Features
            $table->json('amenities')->nullable(); // wifi, parking, pet_friendly, etc.
            
            // Status
            $table->enum('status', ['available', 'rented', 'pending', 'inactive'])->default('available');
            $table->unsignedInteger('views_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false);
            
            $table->timestamps();
            
            // Indexes for search
            $table->index(['city', 'status']);
            $table->index('property_type');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
