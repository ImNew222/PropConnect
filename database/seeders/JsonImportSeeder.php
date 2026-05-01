<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * JSON Import Seeder
 * 
 * Imports data from JSON files in database_exports/ folder
 * This acts as a backup restore mechanism for your database
 * 
 * Usage:
 *   php artisan db:seed --class=JsonImportSeeder
 * 
 * Or with fresh database:
 *   php artisan migrate:fresh --seed --seeder=JsonImportSeeder
 */
class JsonImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Starting JSON Import...');
        
        // Import in correct order (users first, then properties, then images)
        $this->importUsers();
        $this->importProperties();
        $this->importPropertyImages();
        
        $this->command->info('JSON Import completed successfully!');
    }

    /**
     * Import users from JSON
     */
    protected function importUsers(): void
    {
        $jsonPath = base_path('database_exports/users.json');
        
        if (!file_exists($jsonPath)) {
            $this->command->warn('users.json not found, skipping...');
            return;
        }

        $users = json_decode(file_get_contents($jsonPath), true);
        $count = 0;

        foreach ($users as $userData) {
            // Skip if user already exists
            if (User::where('email', $userData['email'])->exists()) {
                continue;
            }

            User::create([
                'id' => $userData['id'],
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'] ?? Hash::make('password'),
                'role' => $userData['role'] ?? 'tenant',
                'phone' => $userData['phone'] ?? null,
                'avatar' => $userData['avatar'] ?? null,
                'is_verified' => $userData['is_verified'] ?? false,
                'whatsapp' => $userData['whatsapp'] ?? null,
                'facebook' => $userData['facebook'] ?? null,
                'viber' => $userData['viber'] ?? null,
                'telegram' => $userData['telegram'] ?? null,
                'email_verified_at' => $userData['email_verified_at'] ?? null,
                'created_at' => $userData['created_at'] ?? now(),
                'updated_at' => $userData['updated_at'] ?? now(),
            ]);
            $count++;
        }

        $this->command->info("Imported {$count} users");
    }

    /**
     * Import properties from JSON
     */
    protected function importProperties(): void
    {
        $jsonPath = base_path('database_exports/properties.json');
        
        if (!file_exists($jsonPath)) {
            $this->command->warn('properties.json not found, skipping...');
            return;
        }

        $properties = json_decode(file_get_contents($jsonPath), true);
        $count = 0;

        foreach ($properties as $propData) {
            // Skip if property already exists
            if (Property::where('id', $propData['id'])->exists()) {
                continue;
            }

            Property::create([
                'id' => $propData['id'],
                'landlord_id' => $propData['landlord_id'],
                'title' => $propData['title'],
                'description' => $propData['description'],
                'property_type' => $propData['property_type'],
                'price' => $propData['price'],
                'deposit' => $propData['deposit'] ?? null,
                'bedrooms' => $propData['bedrooms'],
                'bathrooms' => $propData['bathrooms'],
                'floor_area' => $propData['floor_area'] ?? null,
                'floor_number' => $propData['floor_number'] ?? null,
                'address' => $propData['address'],
                'city' => $propData['city'] ?? 'Cebu City',
                'latitude' => $propData['latitude'] ?? null,
                'longitude' => $propData['longitude'] ?? null,
                'amenities' => $propData['amenities'] ?? [],
                'status' => $propData['status'] ?? 'available',
                'views_count' => $propData['views_count'] ?? 0,
                'is_featured' => $propData['is_featured'] ?? false,
                'is_verified' => $propData['is_verified'] ?? false,
                'created_at' => $propData['created_at'] ?? now(),
                'updated_at' => $propData['updated_at'] ?? now(),
            ]);
            $count++;
        }

        $this->command->info("Imported {$count} properties");
    }

    /**
     * Import property images from JSON
     */
    protected function importPropertyImages(): void
    {
        $jsonPath = base_path('database_exports/property_images.json');
        
        if (!file_exists($jsonPath)) {
            $this->command->warn('property_images.json not found, skipping...');
            return;
        }

        $images = json_decode(file_get_contents($jsonPath), true);
        $count = 0;

        foreach ($images as $imgData) {
            // Skip if image already exists
            if (PropertyImage::where('id', $imgData['id'])->exists()) {
                continue;
            }

            PropertyImage::create([
                'id' => $imgData['id'],
                'property_id' => $imgData['property_id'],
                'image_path' => $imgData['image_path'],
                'is_primary' => $imgData['is_primary'] ?? false,
                'sort_order' => $imgData['sort_order'] ?? 0,
                'created_at' => $imgData['created_at'] ?? now(),
                'updated_at' => $imgData['updated_at'] ?? now(),
            ]);
            $count++;
        }

        $this->command->info("Imported {$count} property images");
    }
}
