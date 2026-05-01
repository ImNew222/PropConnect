# PropConnect System Tour Guide

A step-by-step guide to test all features of the property management system.

---

## Prerequisites

Make sure your dev server is running:
```bash
php artisan serve
```
Application URL: **http://localhost:8000**

---

## Tour 1: Browse Properties (Public)

### Step 1: View the Rental Page
1. Open http://localhost:8000/rental
2. You should see 12 seeded properties loading from the database
3. Properties include studios, condos, apartments, and houses in Cebu City

### Step 2: Test Filters
- **Search**: Type "IT Park" in the search box
- **Sort**: Change "Sort by price" dropdown to see ordering change
- **View Toggle**: Switch between Grid and List views

### Step 3: Test the API Directly
Open these URLs in your browser or use curl:

```bash
# All properties
curl http://localhost:8000/api/properties

# Filter by type
curl "http://localhost:8000/api/properties?type=condo"

# Filter by price range
curl "http://localhost:8000/api/properties?min_price=20000&max_price=40000"

# Search
curl "http://localhost:8000/api/properties?search=Ayala"

# Sort by price (low to high)
curl "http://localhost:8000/api/properties?sort=price_low"

# Map data (GeoJSON)
curl http://localhost:8000/api/properties-map
```

---

## Tour 2: Tenant Registration & Dashboard

### Step 1: Register as a Renter
1. Go to http://localhost:8000/register
2. Fill in the form:
   - Name: `Test Renter`
   - Email: `renter@test.com`
   - Phone: `+63 912 000 0001`
   - Password: `password123`
   - Confirm Password: `password123`
3. Select **"Renter (looking for property)"**
4. Click **Register**
5. You'll be redirected to `/rental` (auto-verified)

### Step 2: Access Tenant Dashboard
1. Go to http://localhost:8000/tenant/dashboard
2. You should see:
   - Stats cards (Saved: 0, Active Rentals: 0, Past Rentals: 0)
   - "Recently Saved" section (empty)
   - "Browse Properties" button

### Step 3: Save a Property
1. Go to http://localhost:8000/rental
2. Click the **heart icon** on any property card
3. The heart should fill in (saved!)
4. Go back to http://localhost:8000/tenant/saved
5. You should see the saved property

### Step 4: Unsave a Property
1. On the saved properties page
2. Click the **Unsave** button
3. Property should be removed from the list

### Step 5: View Sidebar Navigation
The tenant sidebar should show:
- Dashboard
- Saved Properties
- My Rentals
- Browse Properties
- Settings

---

## Tour 3: Landlord Registration & Verification

### Step 1: Log Out
1. Click your name in the navbar or sidebar
2. Click **Log out**

### Step 2: Register as a Landlord
1. Go to http://localhost:8000/register
2. Fill in the form:
   - Name: `Test Landlord`
   - Email: `landlord@test.com`
   - Phone: `+63 912 000 0002`
   - Password: `password123`
3. Select **"Landlord (listing property)"**
4. Notice the **"Verification Required"** section appears!
5. Upload any image file as your "Valid ID Document"
6. Click **Register**

### Step 3: Verification Pending Page
After registration, you'll be redirected to:
http://localhost:8000/landlord/verification/pending

This page shows:
- Pending status icon
- Your uploaded document status
- "What happens next" steps
- Link to dashboard

> **Note**: In the real app, an admin would approve the document. For testing, we seeded a verified landlord.

---

## Tour 4: Landlord Dashboard (Using Demo Account)

### Step 1: Log in as Demo Landlord
1. Go to http://localhost:8000/login
2. Credentials:
   - Email: `landlord@propconnect.demo`
   - Password: `password123`

### Step 2: Access Property Management
1. Go to http://localhost:8000/landlord/properties
2. You should see all 12 seeded properties

### Step 3: Create a New Property
1. Click **"Add Property"** button
2. Fill in the form:
   - Title: `My Test Property`
   - Description: `A test property for the tour`
   - Property Type: Condo
   - Monthly Rent: 30000
   - Security Deposit: 60000
   - Bedrooms: 2, Bathrooms: 2
   - Floor Area: 50, Floor Number: 10
   - Address: `Test Street, IT Park`
   - City: Cebu City
   - Select some amenities (WiFi, Aircon, etc.)
   - Upload at least one image
3. Click **"Create Property"**
4. You should see your new property in the list!

### Step 4: Edit a Property
1. Click **"Edit"** on any property
2. Change the title or price
3. Try uploading additional images
4. Set a different image as primary
5. Delete an image
6. Click **"Update Property"**

### Step 5: View Sidebar Navigation
The landlord sidebar should show:
- Dashboard
- My Properties
- Settings

---

## Tour 5: API Testing (Advanced)

### Property List with Pagination
```bash
# Page 1, 6 items per page
curl "http://localhost:8000/api/properties?per_page=6&page=1"

# Page 2
curl "http://localhost:8000/api/properties?per_page=6&page=2"
```

### Combined Filters
```bash
# Condos under 30k with pool
curl "http://localhost:8000/api/properties?type=condo&max_price=30000&amenities=pool"
```

### Single Property Details
```bash
# Property ID 1
curl http://localhost:8000/api/properties/1
```

### Map Data for Mapbox
```bash
curl http://localhost:8000/api/properties-map
```
Returns GeoJSON format for map markers.

---

## Database Verification

### Check Tables
```bash
php artisan tinker
```

Then run:
```php
// Count properties
App\Models\Property::count();
// Should return 13 (12 seeded + 1 test)

// Check landlord
App\Models\User::where('role', 'landlord')->first();

// Check saved properties
App\Models\SavedProperty::count();
```

---

## Feature Checklist

| Feature | How to Test | Expected Result |
|---------|-------------|-----------------|
| Property listing | `/rental` | See 12+ properties |
| Property API | `/api/properties` | JSON with properties array |
| Filter by type | `/api/properties?type=condo` | Only condos returned |
| Filter by price | `/api/properties?max_price=20000` | Budget properties |
| Search | Search box on rental page | Real-time filtering |
| Tenant registration | `/register` -> Renter | Auto-verified, redirect to /rental |
| Landlord registration | `/register` -> Landlord | Upload ID, pending verification |
| Tenant dashboard | `/tenant/dashboard` | Stats, recent saves |
| Save property | Click heart icon | Heart fills, saved to account |
| Unsave property | Click Unsave | Property removed |
| Landlord dashboard | `/landlord/properties` | List of owned properties |
| Create property | Add Property form | New property appears in list |
| Edit property | Edit button | Changes saved |
| Upload images | Create/Edit forms | Images displayed |
| Set primary image | Edit form | Star fills, image becomes main |
| Delete image | Edit form | Image removed |

---

## Troubleshooting

### Properties not loading on /rental?
- Check browser console for JavaScript errors
- Verify API works: `curl http://localhost:8000/api/properties`

### Can't log in as demo landlord?
- Re-run seeder: `php artisan db:seed --class=PropertySeeder`

### Images not displaying?
- Run: `php artisan storage:link`

### Database connection errors?
- Check `.env` for correct DB credentials
- Verify PostgreSQL/Supabase is accessible
