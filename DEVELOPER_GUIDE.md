# PropConnect Developer Guide

Complete reference for developers working on the PropConnect rental platform.

---

## Quick Start

```bash
# Clone and setup
git clone https://github.com/KuyaW/Hackathon
cd Swipe-app

# Install dependencies
composer install
npm install

# Configure environment
cp .env.example .env
php artisan key:generate

# Add to .env:
# MAPBOX_ACCESS_TOKEN=your_token_here

# Database setup
php artisan migrate
php artisan db:seed

# Run development server
php artisan serve
npm run dev
```

---

## Project Structure

```
Swipe-app/
├── app/
│   ├── Http/Controllers/
│   │   ├── RentalController.php      # Property listings + API
│   │   ├── Landlord/                 # Landlord property management
│   │   └── Tenant/                   # Tenant saved/rentals
│   └── Models/
│       ├── Property.php              # Main property model
│       ├── PropertyImage.php         # Gallery images
│       ├── User.php                  # Landlords & tenants
│       └── Rental.php                # Rental agreements
├── database/
│   ├── migrations/                   # 11 migration files
│   └── seeders/
│       ├── PropertySeeder.php        # Fake property data
│       └── ExcelPropertySeeder.php   # Import from Excel
├── public/
│   ├── css/
│   │   ├── dark-header.css           # Header component styles
│   │   ├── rental.css                # Rental page
│   │   └── mapbox.css                # Map styling
│   └── javascript/
│       ├── dark-header.js            # Header menu logic
│       ├── filter.js                 # Property filtering
│       ├── mapbox.js                 # Map view controller
│       └── property-loader.js        # Lazy loading properties
└── resources/views/
    ├── components/
    │   └── dark-header.blade.php     # Reusable header
    ├── homepage.blade.php
    ├── rental.blade.php
    └── property-detail.blade.php
```

---

## Database Schema

### Core Tables

| Table | Purpose |
|-------|---------|
| `users` | Landlords & tenants (role field) |
| `properties` | Property listings |
| `property_images` | Gallery images with sort order |
| `saved_properties` | User favorites |
| `rentals` | Active/past rentals |
| `property_views` | Analytics tracking |

### Key Relationships

```
User (landlord) --< Property --< PropertyImage
User (tenant) --< SavedProperty >-- Property
User (tenant) --< Rental >-- Property
```

### Seeders

```bash
# Seed with fake data
php artisan db:seed --class=PropertySeeder

# Import from Excel file
php artisan db:seed --class=ExcelPropertySeeder
```

---

## API Endpoints

### Properties API

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/properties` | List with filters |
| GET | `/api/properties/{id}` | Single property |
| GET | `/api/properties-map` | GeoJSON for map |

### Filter Parameters

```
?type=apartment|condo|house|studio
?min_price=5000&max_price=20000
?bedrooms=1|2|3|4+
?city=Cebu
?search=keyword
?sort=latest|price_low|price_high|featured
?per_page=12
```

### Response Format

```json
{
  "properties": [...],
  "pagination": {
    "total": 62,
    "current_page": 1,
    "last_page": 6,
    "has_more": true
  }
}
```

---

## View Modes (Rental Page)

The rental page supports 3 view modes controlled by `filter.js`:

| Mode | Description |
|------|-------------|
| **Grid** | Card grid layout |
| **List** | List view with optional split map |
| **Map** | Full-screen Mapbox map |

Toggle buttons in `.view-toggles` control the active view.

---

## Header Component

### Usage
```blade
@include('components.dark-header')
```

### Features
- Transparent background with `mix-blend-mode: difference` text
- Animated hamburger menu → dropdown
- Dynamic page title (Welcome → Home/Properties)
- Mobile: bottom bar with slide-up menu

### CSS Classes
- `.dark-header` - Main container
- `.header-dark-section` - Logo + hamburger (dark bg)
- `.header-white-section` - Welcome text (transparent)
- `.header-menu` - Dropdown navigation

---

## Mapbox Integration

### Configuration
```php
// config/services.php
'mapbox' => [
    'token' => env('MAPBOX_ACCESS_TOKEN'),
],
```

### Usage in Views
```blade
<script>
    window.MAPBOX_ACCESS_TOKEN = '{{ config('services.mapbox.token') }}';
</script>
```

### Key Files
- `mapbox.js` - Rental page map
- `property-detail-map.js` - Property detail map with directions
- `mapbox.css` - Map styles

---

## Authentication & Roles

```php
// User roles
'tenant'   - Default, can save/rent properties
'landlord' - Can create/manage properties

// Check role
if (auth()->user()->role === 'landlord') { ... }

// Route middleware
Route::middleware(['auth'])->group(...);
```

---

## Common Commands

```bash
# Fresh database with seeds
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_xxx_table

# Clear caches
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# Check routes
php artisan route:list
```

---

## Environment Variables

| Variable | Required | Description |
|----------|----------|-------------|
| `DB_DATABASE` | ✅ | Database name |
| `DB_USERNAME` | ✅ | Database user |
| `DB_PASSWORD` | ✅ | Database password |
| `MAPBOX_ACCESS_TOKEN` | ✅ | Mapbox API key |
| `APP_URL` | ✅ | Full app URL |

---

## Known Issues & Tips

> [!WARNING]
> **Browser Extensions**: Ad-blockers may block Mapbox API calls. Test in incognito mode.

> [!TIP]
> **Performance**: Property images use lazy loading via Intersection Observer in `property-loader.js`.

> [!IMPORTANT]
> **Mapbox Token**: Never commit tokens. Always use `.env` and `config()`.
