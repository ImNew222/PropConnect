# Database Schema Analysis & Plan

This document outlines the proposed database structure required to support the PropConnect platform (User/Landlord/Admin roles, Property Listings, and Messaging). It allows the development team to understand the data relationships before implementation.

## 1. User Management (Authentication & Logic)
We need a robust user system that handles multiple roles.

### `users` Table
*Base for all accounts.*
*   `id`: Primary Key
*   `name`: Full Name
*   `email`: Unique Email
*   `password`: Hashed Password
*   `role`: Enum (`admin`, `landlord`, `tenant`)
*   `status`: Enum (`active`, `banned`, `pending_verification`)
*   `email_verified_at`: Timestamp
*   `remember_token`: Laravel auth

### `user_profiles` Table
*Extended details for users.*
*   `id`: PK
*   `user_id`: FK to `users`
*   `phone`: Contact number
*   `avatar`: URL/Path to profile picture
*   `bio`: Short description (useful for Landlords)
*   `govt_id_path`: Path to uploaded ID (for verification)
*   `is_verified`: Boolean (Admin approval)

---

## 2. Property Listings (The Core Product)
This needs to be highly detailed to support the filters we built.

### `properties` Table
*   `id`: PK
*   `landlord_id`: FK to `users`
*   `title`: Marketing title (e.g., "Cozy Studio in IT Park")
*   `description`: Full text details
*   `price`: Decimal (Monthly rent)
*   `currency`: Default 'PHP'
*   `status`: Enum (`available`, `rented`, `maintenance`, `archived`)
*   `type`: Enum (`house`, `condo`, `apartment`, `commercial`)
*   `bedrooms`: Integer (0 for studio)
*   `bathrooms`: Integer (or Decimal for 1.5 baths)
*   `size_sqm`: Integer (Area size)
*   `latitude`: Decimal (10, 8) for Mapbox
*   `longitude`: Decimal (11, 8) for Mapbox
*   `address_line`: Full text address
*   `city`: String using for filtering
*   `rental_period`: Enum (`long_term`, `short_term`)

### `property_amenities` Table
*Many-to-Many relationship (or JSON column if simple).*
*   `id`: PK
*   `property_id`: FK to `properties`
*   `has_wifi`: Boolean
*   `has_parking`: Boolean
*   `has_pool`: Boolean
*   `has_ac`: Boolean
*   `has_security`: Boolean
*   `is_furnished`: Boolean
*   *Alternatively, a pivot table `amenity_property` with a master `amenities` table for flexibility.*

### `property_images` Table
*One-to-Many: A property has multiple images.*
*   `id`: PK
*   `property_id`: FK to `properties`
*   `image_path`: Path to storage
*   `is_thumbnail`: Boolean (Cover image)
*   `sort_order`: Integer (for Swiper sequence)

---

## 3. Communication

### `conversations` Table
*Grouping messages between two users regarding a specific context.*
*   `id`: PK
*   `sender_id`: FK to `users` (Tenant)
*   `receiver_id`: FK to `users` (Landlord)
*   `property_id`: FK to `properties` (Review context)
*   `last_message_at`: Timestamp (for sorting inbox)

### `messages` Table
*Individual chat bubbles.*
*   `id`: PK
*   `conversation_id`: FK to `conversations`
*   `user_id`: FK to `users` (Who wrote this specific message)
*   `content`: Text
*   `read_at`: Timestamp (Read receipts)

---

## 4. Admin & Safety

### `verification_requests` Table
*Queue for Admin to verify Landlords.*
*   `id`: PK
*   `user_id`: FK to `users`
*   `document_type`: String
*   `document_path`: String
*   `status`: Enum (`pending`, `approved`, `rejected`)
*   `admin_notes`: Text (Reason for rejection)

### `reports` Table
*For reporting scams or bad behavior.*
*   `id`: PK
*   `reporter_id`: FK to `users`
*   `reported_id`: FK to `users` OR `property_id`
*   `reason`: Enum/String
*   `description`: Details
*   `status`: Enum (`open`, `resolved`)

---

## 5. User Interaction (Favorites)

### `favorites` Table
*   `id`: PK
*   `user_id`: FK to `users`
*   `property_id`: FK to `properties`
*   `created_at`: Timestamp

---

## Technical Considerations for Developers
1.  **Mapbox Integration**: `latitude` and `longitude` are critical. When a Landlord enters an address, we should use a Geocoding API to auto-fill these.
2.  **Images**: Store images in AWS S3 or similar cloud storage, saving only the PATH in the database.
3.  **Roles**: Use a Policy/Gate system in Laravel (e.g., `Gate::allows('upload-property')`) based on the `role` column.
