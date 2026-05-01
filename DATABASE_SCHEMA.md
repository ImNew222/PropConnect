# 🗃️ PropConnect Database Schema

## Overview

Complete database structure for landlord property uploads, user management, and rental platform features.

---

## Tables

### 1. `users`
All users (landlords, renters, admins)

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT | Primary key |
| `name` | VARCHAR(255) | Full name |
| `email` | VARCHAR(255) | Unique email |
| `password` | VARCHAR(255) | Hashed password |
| `phone` | VARCHAR(20) | Contact number |
| `avatar` | VARCHAR(255) | Profile photo URL |
| `role` | ENUM | `landlord`, `renter`, `admin` |
| `is_verified` | BOOLEAN | Email/ID verified |
| `created_at` | TIMESTAMP | Registration date |
| `updated_at` | TIMESTAMP | Last update |

---

### 2. `properties`
Main property listings table

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT | Primary key |
| `landlord_id` | BIGINT FK | References `users.id` |
| `title` | VARCHAR(255) | Property title |
| `description` | TEXT | Full description |
| `property_type` | ENUM | `apartment`, `condo`, `house`, `studio`, `room` |
| `listing_type` | ENUM | `rent`, `sale` |
| `price` | DECIMAL(12,2) | Price amount |
| `price_period` | ENUM | `monthly`, `yearly`, `one-time` |
| `currency` | VARCHAR(3) | `PHP`, `USD` |
| `status` | ENUM | `active`, `paused`, `rented`, `sold` |
| `is_featured` | BOOLEAN | Featured listing |
| `views_count` | INT | Number of views |
| `created_at` | TIMESTAMP | Date listed |
| `updated_at` | TIMESTAMP | Last update |

---

### 3. `property_details`
Extended property specifications

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT | Primary key |
| `property_id` | BIGINT FK | References `properties.id` |
| `bedrooms` | TINYINT | Number of bedrooms |
| `bathrooms` | TINYINT | Number of bathrooms |
| `floor_area` | DECIMAL(8,2) | Size in m² |
| `lot_area` | DECIMAL(8,2) | Lot size (for houses) |
| `floor_number` | TINYINT | Which floor |
| `total_floors` | TINYINT | Total floors in building |
| `year_built` | YEAR | Construction year |
| `parking_slots` | TINYINT | Parking spaces |
| `furnishing` | ENUM | `unfurnished`, `semi-furnished`, `fully-furnished` |

---

### 4. `property_locations`
Location and map data

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT | Primary key |
| `property_id` | BIGINT FK | References `properties.id` |
| `address` | VARCHAR(255) | Street address |
| `barangay` | VARCHAR(100) | Barangay |
| `city` | VARCHAR(100) | City (e.g., Cebu City) |
| `province` | VARCHAR(100) | Province |
| `zip_code` | VARCHAR(10) | Postal code |
| `latitude` | DECIMAL(10,8) | GPS latitude |
| `longitude` | DECIMAL(11,8) | GPS longitude |
| `map_zoom` | TINYINT | Default map zoom level |

---

### 5. `property_images`
Multiple images per property

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT | Primary key |
| `property_id` | BIGINT FK | References `properties.id` |
| `image_url` | VARCHAR(500) | Image URL/path |
| `is_primary` | BOOLEAN | Main display image |
| `caption` | VARCHAR(255) | Image description |
| `sort_order` | TINYINT | Display order |
| `created_at` | TIMESTAMP | Upload date |

---

### 6. `amenities`
Master list of amenities

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT | Primary key |
| `name` | VARCHAR(100) | Amenity name |
| `icon` | VARCHAR(50) | Icon identifier |
| `category` | ENUM | `basic`, `comfort`, `security`, `building` |

**Default amenities:**
- Basic: WiFi, Water, Electricity, Gas
- Comfort: AC, Heater, Washer, Dryer, Kitchen
- Security: CCTV, Guard, Gated, Alarm
- Building: Pool, Gym, Elevator, Parking, Rooftop

---

### 7. `property_amenities`
Junction table (many-to-many)

| Column | Type | Description |
|--------|------|-------------|
| `property_id` | BIGINT FK | References `properties.id` |
| `amenity_id` | BIGINT FK | References `amenities.id` |

---

### 8. `favorites`
User saved properties

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT | Primary key |
| `user_id` | BIGINT FK | Renter who saved |
| `property_id` | BIGINT FK | Saved property |
| `created_at` | TIMESTAMP | When saved |

---

### 9. `inquiries`
Messages from renters to landlords

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT | Primary key |
| `property_id` | BIGINT FK | Property inquired about |
| `sender_id` | BIGINT FK | Renter asking |
| `landlord_id` | BIGINT FK | Property owner |
| `message` | TEXT | Inquiry message |
| `status` | ENUM | `pending`, `read`, `replied` |
| `created_at` | TIMESTAMP | When sent |

---

### 10. `property_views`
Analytics tracking

| Column | Type | Description |
|--------|------|-------------|
| `id` | BIGINT | Primary key |
| `property_id` | BIGINT FK | Viewed property |
| `user_id` | BIGINT FK | Viewer (nullable for guests) |
| `ip_address` | VARCHAR(45) | Visitor IP |
| `viewed_at` | TIMESTAMP | View timestamp |

---

## Entity Relationship Diagram

```
┌─────────────┐       ┌─────────────────┐       ┌─────────────┐
│   users     │       │   properties    │       │  amenities  │
│─────────────│       │─────────────────│       │─────────────│
│ id          │◄──────│ landlord_id     │       │ id          │
│ name        │       │ id              │◄──┬──►│ name        │
│ email       │       │ title           │   │   │ icon        │
│ role        │       │ price           │   │   └─────────────┘
└─────────────┘       │ status          │   │
       │              └────────┬────────┘   │
       │                       │            │
       ▼                       ▼            │
┌─────────────┐       ┌─────────────────┐   │
│  favorites  │       │property_details │   │
│─────────────│       │─────────────────│   │
│ user_id     │       │ property_id     │   │
│ property_id │       │ bedrooms        │   │
└─────────────┘       │ floor_area      │   │
                      └─────────────────┘   │
                               │            │
                      ┌────────┴────────┐   │
                      ▼                 ▼   │
              ┌─────────────┐   ┌───────────────────┐
              │  locations  │   │property_amenities │
              │─────────────│   │───────────────────│
              │ latitude    │   │ property_id       │
              │ longitude   │   │ amenity_id        │◄──┘
              │ city        │   └───────────────────┘
              └─────────────┘
```

---

## Landlord Upload Form Fields

When landlord adds a property, they fill:

### Step 1: Basic Info
- [ ] Title
- [ ] Description  
- [ ] Property Type (dropdown)
- [ ] Listing Type (Rent/Sale)
- [ ] Price + Period

### Step 2: Details
- [ ] Bedrooms
- [ ] Bathrooms
- [ ] Floor Area (m²)
- [ ] Furnishing Status
- [ ] Year Built
- [ ] Parking Slots

### Step 3: Location
- [ ] Address
- [ ] City/Barangay
- [ ] Province
- [ ] ZIP Code
- [ ] **Map Pin** (latitude/longitude from Mapbox)

### Step 4: Amenities
- [ ] Checkbox grid of amenities
- [ ] Can add custom amenities

### Step 5: Photos
- [ ] Upload multiple images
- [ ] Set primary image
- [ ] Drag to reorder

### Step 6: Review & Publish
- [ ] Preview listing
- [ ] Set as Draft or Publish

---

## Laravel Migration Commands

```bash
# Create migrations
php artisan make:migration create_users_table
php artisan make:migration create_properties_table
php artisan make:migration create_property_details_table
php artisan make:migration create_property_locations_table
php artisan make:migration create_property_images_table
php artisan make:migration create_amenities_table
php artisan make:migration create_property_amenities_table
php artisan make:migration create_favorites_table
php artisan make:migration create_inquiries_table
php artisan make:migration create_property_views_table

# Run migrations
php artisan migrate
```
