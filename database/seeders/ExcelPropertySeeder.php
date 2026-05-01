<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelPropertySeeder extends Seeder
{
    /**
     * Known Cebu City locations with approximate coordinates
     */
    protected array $cebuLocations = [
        'ayala' => ['lat' => 10.3157, 'lng' => 123.8854],
        'it park' => ['lat' => 10.3279, 'lng' => 123.9061],
        'mango' => ['lat' => 10.3097, 'lng' => 123.8907],
        'colon' => ['lat' => 10.2969, 'lng' => 123.8997],
        'fuente' => ['lat' => 10.3103, 'lng' => 123.8914],
        'sm city' => ['lat' => 10.3116, 'lng' => 123.9185],
        'sm seaside' => ['lat' => 10.2815, 'lng' => 123.8791],
        'jones' => ['lat' => 10.3050, 'lng' => 123.8930],
        'capitol' => ['lat' => 10.3167, 'lng' => 123.8900],
        'banilad' => ['lat' => 10.3400, 'lng' => 123.9000],
        'lahug' => ['lat' => 10.3280, 'lng' => 123.8960],
        'guadalupe' => ['lat' => 10.3050, 'lng' => 123.9100],
        'talamban' => ['lat' => 10.3550, 'lng' => 123.9100],
        'mandaue' => ['lat' => 10.3450, 'lng' => 123.9350],
        'mactan' => ['lat' => 10.3100, 'lng' => 123.9700],
        'consolacion' => ['lat' => 10.3750, 'lng' => 123.9550],
        'liloan' => ['lat' => 10.4000, 'lng' => 123.9800],
        'talisay' => ['lat' => 10.2500, 'lng' => 123.8450],
        'minglanilla' => ['lat' => 10.2350, 'lng' => 123.8000],
        'default' => ['lat' => 10.3103, 'lng' => 123.8914], // Cebu City center
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = base_path('cebu_property_listings.xlsx');
        
        if (!file_exists($filePath)) {
            $this->command->error('Excel file not found: ' . $filePath);
            return;
        }

        $spreadsheet = IOFactory::load($filePath);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);
        
        // Get headers from first row
        $headers = array_shift($rows);
        
        $this->command->info('Importing ' . count($rows) . ' properties from Excel...');
        
        $landlordCache = [];
        $count = 0;

        foreach ($rows as $rowIndex => $row) {
            if (empty($row['B'])) continue; // Skip empty rows
            
            // Get or create landlord user
            $landlordEmail = trim($row['S'] ?? 'landlord@example.com');
            
            if (!isset($landlordCache[$landlordEmail])) {
                $landlord = User::firstOrCreate(
                    ['email' => $landlordEmail],
                    [
                        'name' => trim($row['Q'] ?? 'Landlord'),
                        'password' => Hash::make('password'),
                        'role' => 'landlord',
                        'phone' => $this->formatPhone($row['R'] ?? ''),
                        'is_verified' => true,
                    ]
                );
                $landlordCache[$landlordEmail] = $landlord->id;
            }

            // Generate coordinates from location
            $location = $row['E'] ?? 'Cebu City';
            $coords = $this->getCoordinates($location);

            // Parse price (remove currency symbol and commas)
            $price = $this->parsePrice($row['K'] ?? '0');
            $deposit = $this->parsePrice($row['L'] ?? '0');

            // Parse amenities
            $amenities = $this->parseAmenities($row['O'] ?? '', $row['P'] ?? '');

            // Map property type
            $propertyType = $this->mapPropertyType($row['D'] ?? 'apartment');

            Property::create([
                'landlord_id' => $landlordCache[$landlordEmail],
                'title' => trim($row['B'] ?? 'Property'),
                'description' => trim($row['F'] ?? ''),
                'property_type' => $propertyType,
                'price' => $price,
                'deposit' => $deposit,
                'bedrooms' => (int) ($row['H'] ?? 0),
                'bathrooms' => (int) ($row['I'] ?? 1),
                'floor_area' => (float) ($row['G'] ?? 0),
                'floor_number' => (int) ($row['J'] ?? 1),
                'address' => trim($row['E'] ?? 'Cebu City'),
                'city' => 'Cebu City',
                'latitude' => $coords['lat'],
                'longitude' => $coords['lng'],
                'amenities' => $amenities,
                'status' => 'available',
                'is_featured' => $count < 5, // First 5 are featured
                'is_verified' => true,
                'views_count' => rand(50, 500),
            ]);

            $count++;
        }

        $this->command->info("Successfully imported {$count} properties!");
    }

    /**
     * Get coordinates from location string
     */
    protected function getCoordinates(string $location): array
    {
        $location = strtolower($location);
        
        // Try to match known locations
        foreach ($this->cebuLocations as $key => $coords) {
            if (str_contains($location, $key)) {
                // Add small random offset for variety (±0.005 degrees ≈ 500m)
                return [
                    'lat' => $coords['lat'] + (rand(-50, 50) / 10000),
                    'lng' => $coords['lng'] + (rand(-50, 50) / 10000),
                ];
            }
        }

        // Default: random location in Cebu City area
        return [
            'lat' => 10.3103 + (rand(-100, 100) / 10000),
            'lng' => 123.8914 + (rand(-100, 100) / 10000),
        ];
    }

    /**
     * Parse price string to float
     */
    protected function parsePrice(string $price): float
    {
        // Remove currency symbol, commas, spaces
        $cleaned = preg_replace('/[^0-9.]/', '', $price);
        return (float) ($cleaned ?: 0);
    }

    /**
     * Format phone number
     */
    protected function formatPhone(string $phone): string
    {
        $cleaned = preg_replace('/[^0-9+]/', '', $phone);
        if (strlen($cleaned) === 11 && str_starts_with($cleaned, '0')) {
            return '+63 ' . substr($cleaned, 1, 3) . ' ' . substr($cleaned, 4, 3) . ' ' . substr($cleaned, 7);
        }
        return $phone;
    }

    /**
     * Parse amenities from Excel columns
     */
    protected function parseAmenities(string $amenities, string $features): array
    {
        $combined = strtolower($amenities . ', ' . $features);
        $result = [];

        $mapping = [
            'wifi' => 'wifi',
            'internet' => 'wifi',
            'aircon' => 'aircon',
            'air condition' => 'aircon',
            'a/c' => 'aircon',
            'pool' => 'pool',
            'swimming' => 'pool',
            'gym' => 'gym',
            'fitness' => 'gym',
            'parking' => 'parking',
            'garage' => 'parking',
            'furnished' => 'furnished',
            'pet' => 'pet_friendly',
            'elevator' => 'elevator',
            'lift' => 'elevator',
            'balcony' => 'balcony',
            'terrace' => 'balcony',
            'security' => 'security',
            'guard' => 'security',
            'cctv' => 'security',
            'laundry' => 'laundry',
            'washing' => 'laundry',
            'kitchen' => 'kitchen',
            'rooftop' => 'rooftop',
        ];

        foreach ($mapping as $keyword => $amenity) {
            if (str_contains($combined, $keyword) && !in_array($amenity, $result)) {
                $result[] = $amenity;
            }
        }

        return $result;
    }

    /**
     * Map property type string to enum value
     */
    protected function mapPropertyType(string $type): string
    {
        $type = strtolower($type);
        
        $mapping = [
            'studio' => 'studio',
            'condo' => 'condo',
            'condominium' => 'condo',
            'apartment' => 'apartment',
            'house' => 'house',
            'townhouse' => 'house',
            'hotel' => 'hotel',
            'room' => 'room',
            'bedspace' => 'room',
            'serviced' => 'apartment',
            'loft' => 'studio',
            'penthouse' => 'condo',
        ];

        foreach ($mapping as $keyword => $propertyType) {
            if (str_contains($type, $keyword)) {
                return $propertyType;
            }
        }

        return 'apartment';
    }
}
