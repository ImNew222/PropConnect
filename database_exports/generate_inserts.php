<?php
/**
 * Generate SQL INSERT Statements from JSON files
 * 
 * This script reads JSON exports and generates INSERT SQL statements
 * that can be run in Supabase SQL Editor or any PostgreSQL client.
 * 
 * Usage:
 *   php database_exports/generate_inserts.php > database_exports/data.sql
 *   
 * Or run directly:
 *   php database_exports/generate_inserts.php
 */

$baseDir = __DIR__;

echo "-- ============================================\n";
echo "-- PropConnect Data INSERT Statements\n";
echo "-- Generated: " . date('Y-m-d H:i:s') . "\n";
echo "-- \n";
echo "-- Run schema.sql FIRST before running this!\n";
echo "-- ============================================\n\n";

// ============================================
// HELPER FUNCTIONS
// ============================================

function escapeValue($value) {
    if ($value === null) {
        return 'NULL';
    }
    if (is_bool($value)) {
        return $value ? 'TRUE' : 'FALSE';
    }
    if (is_array($value)) {
        return "'" . addslashes(json_encode($value)) . "'";
    }
    if (is_numeric($value) && !is_string($value)) {
        return $value;
    }
    return "'" . addslashes($value) . "'";
}

// ============================================
// GENERATE USER INSERTS
// ============================================
$usersFile = "{$baseDir}/users.json";
if (file_exists($usersFile)) {
    $users = json_decode(file_get_contents($usersFile), true);
    
    echo "-- ============================================\n";
    echo "-- USERS (" . count($users) . " records)\n";
    echo "-- ============================================\n\n";
    
    foreach ($users as $user) {
        $values = [
            escapeValue($user['id']),
            escapeValue($user['name']),
            escapeValue($user['email']),
            escapeValue($user['role'] ?? 'tenant'),
            escapeValue($user['phone'] ?? null),
            escapeValue($user['avatar'] ?? null),
            $user['is_verified'] ? 'TRUE' : 'FALSE',
            escapeValue($user['whatsapp'] ?? null),
            escapeValue($user['facebook'] ?? null),
            escapeValue($user['viber'] ?? null),
            escapeValue($user['telegram'] ?? null),
            escapeValue($user['email_verified_at'] ?? null),
            escapeValue($user['password'] ?? '$2y$12$default'),
            'NULL', // remember_token
            escapeValue($user['created_at'] ?? date('Y-m-d H:i:s')),
            escapeValue($user['updated_at'] ?? date('Y-m-d H:i:s')),
        ];
        
        echo "INSERT INTO users (id, name, email, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, password, remember_token, created_at, updated_at) VALUES\n";
        echo "(" . implode(', ', $values) . ")\n";
        echo "ON CONFLICT (id) DO NOTHING;\n\n";
    }
    
    // Reset sequence
    echo "-- Reset users sequence\n";
    echo "SELECT setval('users_id_seq', (SELECT MAX(id) FROM users));\n\n";
}

// ============================================
// GENERATE PROPERTY INSERTS
// ============================================
$propertiesFile = "{$baseDir}/properties.json";
if (file_exists($propertiesFile)) {
    $properties = json_decode(file_get_contents($propertiesFile), true);
    
    echo "-- ============================================\n";
    echo "-- PROPERTIES (" . count($properties) . " records)\n";
    echo "-- ============================================\n\n";
    
    foreach ($properties as $prop) {
        $values = [
            escapeValue($prop['id']),
            escapeValue($prop['landlord_id']),
            escapeValue($prop['title']),
            escapeValue($prop['description'] ?? null),
            escapeValue($prop['property_type'] ?? 'apartment'),
            escapeValue($prop['price']),
            escapeValue($prop['deposit'] ?? null),
            escapeValue($prop['bedrooms'] ?? 1),
            escapeValue($prop['bathrooms'] ?? 1),
            escapeValue($prop['floor_area'] ?? null),
            escapeValue($prop['floor_number'] ?? null),
            escapeValue($prop['address']),
            escapeValue($prop['city'] ?? 'Cebu City'),
            escapeValue($prop['latitude'] ?? null),
            escapeValue($prop['longitude'] ?? null),
            escapeValue($prop['amenities'] ?? []),
            escapeValue($prop['status'] ?? 'available'),
            escapeValue($prop['views_count'] ?? 0),
            ($prop['is_featured'] ?? false) ? 'TRUE' : 'FALSE',
            ($prop['is_verified'] ?? false) ? 'TRUE' : 'FALSE',
            escapeValue($prop['created_at'] ?? date('Y-m-d H:i:s')),
            escapeValue($prop['updated_at'] ?? date('Y-m-d H:i:s')),
        ];
        
        echo "INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at) VALUES\n";
        echo "(" . implode(', ', $values) . ")\n";
        echo "ON CONFLICT (id) DO NOTHING;\n\n";
    }
    
    // Reset sequence
    echo "-- Reset properties sequence\n";
    echo "SELECT setval('properties_id_seq', (SELECT MAX(id) FROM properties));\n\n";
}

// ============================================
// GENERATE PROPERTY IMAGE INSERTS
// ============================================
$imagesFile = "{$baseDir}/property_images.json";
if (file_exists($imagesFile)) {
    $images = json_decode(file_get_contents($imagesFile), true);
    
    echo "-- ============================================\n";
    echo "-- PROPERTY IMAGES (" . count($images) . " records)\n";
    echo "-- ============================================\n\n";
    
    foreach ($images as $img) {
        $values = [
            escapeValue($img['id']),
            escapeValue($img['property_id']),
            escapeValue($img['image_path']),
            ($img['is_primary'] ?? false) ? 'TRUE' : 'FALSE',
            escapeValue($img['sort_order'] ?? 0),
            escapeValue($img['created_at'] ?? date('Y-m-d H:i:s')),
            escapeValue($img['updated_at'] ?? date('Y-m-d H:i:s')),
        ];
        
        echo "INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at) VALUES\n";
        echo "(" . implode(', ', $values) . ")\n";
        echo "ON CONFLICT (id) DO NOTHING;\n\n";
    }
    
    // Reset sequence
    echo "-- Reset property_images sequence\n";
    echo "SELECT setval('property_images_id_seq', (SELECT MAX(id) FROM property_images));\n\n";
}

echo "-- ============================================\n";
echo "-- DATA IMPORT COMPLETE!\n";
echo "-- ============================================\n";
