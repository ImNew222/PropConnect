<?php
/**
 * Standalone JSON to Database Import Script
 * 
 * This script can be run directly to import JSON data into your Supabase PostgreSQL database.
 * 
 * Usage:
 *   php database_exports/import_to_database.php
 * 
 * Prerequisites:
 *   - PDO PostgreSQL extension enabled
 *   - JSON files in the same directory (users.json, properties.json, property_images.json)
 */

// ============================================
// DATABASE CONFIGURATION (from your .env)
// ============================================
$config = [
    'host' => getenv('DB_HOST') ?: 'your-supabase-host.pooler.supabase.com',
    'port' => getenv('DB_PORT') ?: '5432',
    'database' => getenv('DB_DATABASE') ?: 'postgres',
    'username' => getenv('DB_USERNAME') ?: 'your_db_username',
    'password' => getenv('DB_PASSWORD') ?: 'your_db_password',
];

// ============================================
// CONNECT TO DATABASE
// ============================================
try {
    $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['database']}";
    $pdo = new PDO($dsn, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "✅ Connected to Supabase PostgreSQL\n\n";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage() . "\n");
}

// ============================================
// IMPORT FUNCTIONS
// ============================================

function importUsers(PDO $pdo, string $jsonFile): int {
    if (!file_exists($jsonFile)) {
        echo "⚠️  users.json not found, skipping...\n";
        return 0;
    }

    $users = json_decode(file_get_contents($jsonFile), true);
    $count = 0;

    $sql = "INSERT INTO users (id, name, email, password, role, phone, avatar, is_verified, whatsapp, facebook, viber, telegram, email_verified_at, created_at, updated_at)
            VALUES (:id, :name, :email, :password, :role, :phone, :avatar, :is_verified, :whatsapp, :facebook, :viber, :telegram, :email_verified_at, :created_at, :updated_at)
            ON CONFLICT (id) DO NOTHING";
    
    $stmt = $pdo->prepare($sql);

    foreach ($users as $user) {
        try {
            $stmt->execute([
                ':id' => $user['id'],
                ':name' => $user['name'],
                ':email' => $user['email'],
                ':password' => $user['password'] ?? '$2y$12$default',
                ':role' => $user['role'] ?? 'tenant',
                ':phone' => $user['phone'] ?? null,
                ':avatar' => $user['avatar'] ?? null,
                ':is_verified' => $user['is_verified'] ? 'true' : 'false',
                ':whatsapp' => $user['whatsapp'] ?? null,
                ':facebook' => $user['facebook'] ?? null,
                ':viber' => $user['viber'] ?? null,
                ':telegram' => $user['telegram'] ?? null,
                ':email_verified_at' => $user['email_verified_at'] ?? null,
                ':created_at' => $user['created_at'] ?? date('Y-m-d H:i:s'),
                ':updated_at' => $user['updated_at'] ?? date('Y-m-d H:i:s'),
            ]);
            $count++;
        } catch (PDOException $e) {
            echo "  ⚠️ User {$user['email']}: " . $e->getMessage() . "\n";
        }
    }

    return $count;
}

function importProperties(PDO $pdo, string $jsonFile): int {
    if (!file_exists($jsonFile)) {
        echo "⚠️  properties.json not found, skipping...\n";
        return 0;
    }

    $properties = json_decode(file_get_contents($jsonFile), true);
    $count = 0;

    $sql = "INSERT INTO properties (id, landlord_id, title, description, property_type, price, deposit, bedrooms, bathrooms, floor_area, floor_number, address, city, latitude, longitude, amenities, status, views_count, is_featured, is_verified, created_at, updated_at)
            VALUES (:id, :landlord_id, :title, :description, :property_type, :price, :deposit, :bedrooms, :bathrooms, :floor_area, :floor_number, :address, :city, :latitude, :longitude, :amenities, :status, :views_count, :is_featured, :is_verified, :created_at, :updated_at)
            ON CONFLICT (id) DO NOTHING";
    
    $stmt = $pdo->prepare($sql);

    foreach ($properties as $prop) {
        try {
            $stmt->execute([
                ':id' => $prop['id'],
                ':landlord_id' => $prop['landlord_id'],
                ':title' => $prop['title'],
                ':description' => $prop['description'],
                ':property_type' => $prop['property_type'],
                ':price' => $prop['price'],
                ':deposit' => $prop['deposit'] ?? null,
                ':bedrooms' => $prop['bedrooms'],
                ':bathrooms' => $prop['bathrooms'],
                ':floor_area' => $prop['floor_area'] ?? null,
                ':floor_number' => $prop['floor_number'] ?? null,
                ':address' => $prop['address'],
                ':city' => $prop['city'] ?? 'Cebu City',
                ':latitude' => $prop['latitude'] ?? null,
                ':longitude' => $prop['longitude'] ?? null,
                ':amenities' => json_encode($prop['amenities'] ?? []),
                ':status' => $prop['status'] ?? 'available',
                ':views_count' => $prop['views_count'] ?? 0,
                ':is_featured' => ($prop['is_featured'] ?? false) ? 'true' : 'false',
                ':is_verified' => ($prop['is_verified'] ?? false) ? 'true' : 'false',
                ':created_at' => $prop['created_at'] ?? date('Y-m-d H:i:s'),
                ':updated_at' => $prop['updated_at'] ?? date('Y-m-d H:i:s'),
            ]);
            $count++;
        } catch (PDOException $e) {
            echo "  ⚠️ Property {$prop['id']}: " . $e->getMessage() . "\n";
        }
    }

    return $count;
}

function importPropertyImages(PDO $pdo, string $jsonFile): int {
    if (!file_exists($jsonFile)) {
        echo "⚠️  property_images.json not found, skipping...\n";
        return 0;
    }

    $images = json_decode(file_get_contents($jsonFile), true);
    $count = 0;

    $sql = "INSERT INTO property_images (id, property_id, image_path, is_primary, sort_order, created_at, updated_at)
            VALUES (:id, :property_id, :image_path, :is_primary, :sort_order, :created_at, :updated_at)
            ON CONFLICT (id) DO NOTHING";
    
    $stmt = $pdo->prepare($sql);

    foreach ($images as $img) {
        try {
            $stmt->execute([
                ':id' => $img['id'],
                ':property_id' => $img['property_id'],
                ':image_path' => $img['image_path'],
                ':is_primary' => ($img['is_primary'] ?? false) ? 'true' : 'false',
                ':sort_order' => $img['sort_order'] ?? 0,
                ':created_at' => $img['created_at'] ?? date('Y-m-d H:i:s'),
                ':updated_at' => $img['updated_at'] ?? date('Y-m-d H:i:s'),
            ]);
            $count++;
        } catch (PDOException $e) {
            echo "  ⚠️ Image {$img['id']}: " . $e->getMessage() . "\n";
        }
    }

    return $count;
}

// ============================================
// RUN IMPORT
// ============================================
echo "🚀 Starting JSON Import to Supabase...\n\n";

$baseDir = __DIR__;

echo "📦 Importing Users...\n";
$usersCount = importUsers($pdo, "{$baseDir}/users.json");
echo "   ✅ Imported {$usersCount} users\n\n";

echo "📦 Importing Properties...\n";
$propertiesCount = importProperties($pdo, "{$baseDir}/properties.json");
echo "   ✅ Imported {$propertiesCount} properties\n\n";

echo "📦 Importing Property Images...\n";
$imagesCount = importPropertyImages($pdo, "{$baseDir}/property_images.json");
echo "   ✅ Imported {$imagesCount} property images\n\n";

echo "════════════════════════════════════════\n";
echo "✅ Import Complete!\n";
echo "   Users: {$usersCount}\n";
echo "   Properties: {$propertiesCount}\n";
echo "   Images: {$imagesCount}\n";
echo "════════════════════════════════════════\n";
