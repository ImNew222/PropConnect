-- ============================================
-- PropConnect Database Schema for PostgreSQL/Supabase
-- Generated from Laravel migrations
-- 
-- Usage: Run this in Supabase SQL Editor or psql
-- ============================================

-- Drop existing tables (in reverse order due to foreign keys)
DROP TABLE IF EXISTS landlord_documents CASCADE;
DROP TABLE IF EXISTS property_views CASCADE;
DROP TABLE IF EXISTS rentals CASCADE;
DROP TABLE IF EXISTS saved_properties CASCADE;
DROP TABLE IF EXISTS property_images CASCADE;
DROP TABLE IF EXISTS properties CASCADE;
DROP TABLE IF EXISTS sessions CASCADE;
DROP TABLE IF EXISTS password_reset_tokens CASCADE;
DROP TABLE IF EXISTS users CASCADE;

-- ============================================
-- 1. USERS TABLE
-- ============================================
CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role VARCHAR(20) DEFAULT 'renter' CHECK (role IN ('landlord', 'renter', 'admin', 'tenant')),
    phone VARCHAR(20),
    avatar VARCHAR(255),
    is_verified BOOLEAN DEFAULT FALSE,
    whatsapp VARCHAR(255),
    facebook VARCHAR(255),
    viber VARCHAR(255),
    telegram VARCHAR(255),
    email_verified_at TIMESTAMP,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- 2. PASSWORD RESET TOKENS TABLE
-- ============================================
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP
);

-- ============================================
-- 3. SESSIONS TABLE
-- ============================================
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT REFERENCES users(id) ON DELETE CASCADE,
    ip_address VARCHAR(45),
    user_agent TEXT,
    payload TEXT NOT NULL,
    last_activity INTEGER NOT NULL
);
CREATE INDEX sessions_user_id_idx ON sessions(user_id);
CREATE INDEX sessions_last_activity_idx ON sessions(last_activity);

-- ============================================
-- 4. PROPERTIES TABLE
-- ============================================
CREATE TABLE properties (
    id BIGSERIAL PRIMARY KEY,
    landlord_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    
    -- Basic info
    title VARCHAR(255) NOT NULL,
    description TEXT,
    property_type VARCHAR(20) DEFAULT 'apartment' CHECK (property_type IN ('studio', 'condo', 'apartment', 'house', 'hotel', 'room')),
    
    -- Pricing
    price DECIMAL(10, 2) NOT NULL,
    deposit DECIMAL(10, 2),
    
    -- Specs
    bedrooms INTEGER DEFAULT 1,
    bathrooms INTEGER DEFAULT 1,
    floor_area DECIMAL(8, 2),
    floor_number INTEGER,
    
    -- Location
    address VARCHAR(255) NOT NULL,
    city VARCHAR(255) DEFAULT 'Cebu City',
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    
    -- Features (JSON)
    amenities JSONB,
    
    -- Status
    status VARCHAR(20) DEFAULT 'available' CHECK (status IN ('available', 'rented', 'pending', 'inactive')),
    views_count INTEGER DEFAULT 0,
    is_featured BOOLEAN DEFAULT FALSE,
    is_verified BOOLEAN DEFAULT FALSE,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX properties_city_status_idx ON properties(city, status);
CREATE INDEX properties_type_idx ON properties(property_type);
CREATE INDEX properties_price_idx ON properties(price);

-- ============================================
-- 5. PROPERTY IMAGES TABLE
-- ============================================
CREATE TABLE property_images (
    id BIGSERIAL PRIMARY KEY,
    property_id BIGINT NOT NULL REFERENCES properties(id) ON DELETE CASCADE,
    image_path VARCHAR(255) NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    sort_order INTEGER DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- 6. SAVED PROPERTIES TABLE (Favorites)
-- ============================================
CREATE TABLE saved_properties (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    property_id BIGINT NOT NULL REFERENCES properties(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(user_id, property_id)
);

-- ============================================
-- 7. RENTALS TABLE
-- ============================================
CREATE TABLE rentals (
    id BIGSERIAL PRIMARY KEY,
    property_id BIGINT NOT NULL REFERENCES properties(id) ON DELETE CASCADE,
    tenant_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    landlord_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    start_date DATE NOT NULL,
    end_date DATE,
    monthly_rent DECIMAL(10, 2) NOT NULL,
    deposit_paid DECIMAL(10, 2),
    status VARCHAR(20) DEFAULT 'active' CHECK (status IN ('active', 'completed', 'cancelled')),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX rentals_status_idx ON rentals(status);

-- ============================================
-- 8. PROPERTY VIEWS TABLE
-- ============================================
CREATE TABLE property_views (
    id BIGSERIAL PRIMARY KEY,
    property_id BIGINT NOT NULL REFERENCES properties(id) ON DELETE CASCADE,
    viewer_id BIGINT REFERENCES users(id) ON DELETE SET NULL,
    ip_address VARCHAR(45),
    viewed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX property_views_viewed_at_idx ON property_views(viewed_at);

-- ============================================
-- 9. LANDLORD DOCUMENTS TABLE
-- ============================================
CREATE TABLE landlord_documents (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    document_type VARCHAR(30) DEFAULT 'id_proof' CHECK (document_type IN ('id_proof', 'property_ownership', 'business_permit')),
    document_path VARCHAR(255) NOT NULL,
    status VARCHAR(20) DEFAULT 'pending' CHECK (status IN ('pending', 'approved', 'rejected')),
    rejection_reason TEXT,
    reviewed_at TIMESTAMP,
    reviewed_by BIGINT REFERENCES users(id) ON DELETE SET NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE INDEX landlord_documents_status_idx ON landlord_documents(status);

-- ============================================
-- SCHEMA CREATED SUCCESSFULLY!
-- Now run the data import script
-- ============================================
