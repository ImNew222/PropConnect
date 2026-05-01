<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyImage;

class PropertyImageSeeder extends Seeder
{
    /**
     * Placeholder image sets - each property gets a unique set
     */
    private array $imageSets = [
        // Set 1: Modern apartment
        [
            'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800',
            'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
            'https://images.unsplash.com/photo-1560185893-a55cbc8c57e8?w=800',
            'https://images.unsplash.com/photo-1552321554-5fefe8c9ef14?w=800',
        ],
        // Set 2: Luxury condo
        [
            'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800',
            'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=800',
            'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800',
            'https://images.unsplash.com/photo-1600573472592-401b489a3cdc?w=800',
        ],
        // Set 3: Studio unit
        [
            'https://images.unsplash.com/photo-1560185127-6a8b0f8f7a66?w=800',
            'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800',
            'https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=800',
            'https://images.unsplash.com/photo-1484154218962-a197022b5858?w=800',
        ],
        // Set 4: Cozy bedroom
        [
            'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800',
            'https://images.unsplash.com/photo-1630699144867-37acec97df5a?w=800',
            'https://images.unsplash.com/photo-1617325247661-675ab4b64ae2?w=800',
            'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800',
        ],
        // Set 5: Beach house
        [
            'https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?w=800',
            'https://images.unsplash.com/photo-1510798831971-661eb04b3739?w=800',
            'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800',
            'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
        ],
        // Set 6: City view
        [
            'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
            'https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800',
            'https://images.unsplash.com/photo-1560448204-603b3fc33ddc?w=800',
            'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800',
        ],
        // Set 7: Minimalist
        [
            'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=800',
            'https://images.unsplash.com/photo-1598928506311-c55ez365176e?w=800',
            'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=800',
            'https://images.unsplash.com/photo-1616137466211-f939a420be84?w=800',
        ],
        // Set 8: Industrial loft
        [
            'https://images.unsplash.com/photo-1536376072261-38c75010e6c9?w=800',
            'https://images.unsplash.com/photo-1515263487990-61b07816b324?w=800',
            'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800',
            'https://images.unsplash.com/photo-1566665797739-1674de7a421a?w=800',
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing images
        PropertyImage::truncate();
        
        $properties = Property::all();
        $setCount = count($this->imageSets);
        
        foreach ($properties as $index => $property) {
            // Get a unique image set for this property (cycles through sets)
            $imageSet = $this->imageSets[$index % $setCount];
            
            foreach ($imageSet as $order => $imageUrl) {
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $imageUrl,
                    'is_primary' => $order === 0,
                    'sort_order' => $order,
                ]);
            }
        }
        
        $this->command->info('Created ' . ($properties->count() * 4) . ' property images for ' . $properties->count() . ' properties.');
    }
}
