import pandas as pd
import random
from faker import Faker

# Initialize Faker for Filipino names
fake = Faker(['fil_PH'])

# Real locations in Cebu City
cebu_locations = [
    "IT Park, Lahug, Cebu City",
    "Ayala Business Park, Cebu City",
    "Baseline Residences, Capitol Site, Cebu City",
    "Mabolo, Cebu City",
    "Banilad, Cebu City",
    "Talamban, Cebu City",
    "Mandaue City (near Cebu City)",
    "Apas, Cebu City",
    "Guadalupe, Cebu City",
    "Capitol Site, Cebu City",
    "Kasambagan, Cebu City",
    "Kamputhaw, Cebu City",
    "Busay, Cebu City",
    "Nivel Hills, Lahug, Cebu City",
    "Mango Avenue, Cebu City",
    "Fuente Osmeña Circle, Cebu City",
    "Colon Street, Cebu City",
    "Jones Avenue, Cebu City",
    "Salinas Drive, Lahug, Cebu City",
    "Archbishop Reyes Avenue, Cebu City",
    "Gorordo Avenue, Cebu City",
    "Escario Street, Cebu City",
    "General Maxilom Avenue, Cebu City",
    "A.S. Fortuna Street, Mandaue City",
    "S.B. Cabahug Street, Cebu City"
]

# Property types
property_types = ["Studio Unit", "1-Bedroom Condo", "2-Bedroom Condo", "Apartment", "Hotel Room", "Serviced Apartment", "Loft Unit"]

# Property name prefixes
property_prefixes = [
    "The", "Grand", "Royal", "Pacific", "Metro", "Urban", "Vista", "Prime", "Elite", "Skyline",
    "Azure", "Crown", "Horizon", "Oasis", "Laguna", "Marina", "Sunset", "Paradise", "Crystal", "Diamond"
]

property_suffixes = [
    "Residences", "Tower", "Heights", "Place", "Suites", "Gardens", "Court", "Mansion", "Plaza", "Villas",
    "Condotel", "Living", "Homes", "Terrace", "Point", "Square", "Park", "Haven", "Estate", "Lodge"
]

# Amenities pool
amenities_pool = [
    "Swimming Pool", "Gym/Fitness Center", "Rooftop Lounge", "24/7 Security", "CCTV Surveillance",
    "Parking Space", "Elevator Access", "Wi-Fi Ready", "Laundry Area", "Reception/Lobby",
    "Backup Generator", "Water Tank", "Mail Room", "Convenience Store", "Function Room",
    "Children's Playground", "Jogging Path", "Basketball Court", "Garden Area", "Pet-Friendly",
    "Concierge Service", "Business Center", "Spa/Sauna", "BBQ Area", "Sky Deck"
]

# Property features pool
features_pool = [
    "Air Conditioning", "Fully Furnished", "Semi-Furnished", "Built-in Closet", "Balcony",
    "City View", "Mountain View", "Sea View", "Kitchen (Gas Range)", "Kitchen (Induction)",
    "Refrigerator Included", "Washing Machine", "Microwave", "Water Heater", "Cable TV Ready",
    "Smart TV Included", "High-Speed Internet", "Modern Interior", "Minimalist Design",
    "Floor-to-Ceiling Windows", "Blackout Curtains", "Sofa Bed", "Dining Set", "Study Desk",
    "Queen-Size Bed", "King-Size Bed"
]

# Generate 50 property entries
data = []

for i in range(50):
    # Generate landlord info with Filipino names
    landlord_name = fake.name()
    landlord_phone = f"09{random.randint(10, 99)}-{random.randint(100, 999)}-{random.randint(1000, 9999)}"
    landlord_email = f"{landlord_name.lower().replace(' ', '.').replace(',', '')}@{random.choice(['gmail.com', 'yahoo.com', 'outlook.com', 'email.com'])}"
    
    # Property details
    prop_type = random.choice(property_types)
    prop_name = f"{random.choice(property_prefixes)} {random.choice(property_suffixes)}"
    location = random.choice(cebu_locations)
    
    # Size based on property type
    if "Studio" in prop_type:
        sqm = random.randint(18, 35)
        beds = 0
        baths = 1
    elif "1-Bedroom" in prop_type:
        sqm = random.randint(30, 50)
        beds = 1
        baths = 1
    elif "2-Bedroom" in prop_type:
        sqm = random.randint(50, 80)
        beds = 2
        baths = random.choice([1, 2])
    elif "Hotel" in prop_type:
        sqm = random.randint(20, 40)
        beds = random.choice([1, 2])
        baths = 1
    elif "Loft" in prop_type:
        sqm = random.randint(40, 70)
        beds = 1
        baths = 1
    else:  # Apartment or Serviced Apartment
        sqm = random.randint(35, 70)
        beds = random.choice([1, 2, 3])
        baths = random.choice([1, 2])
    
    floor = random.randint(1, 40)
    
    # Price based on property type and size
    base_price = sqm * random.randint(400, 800)
    monthly_rent = round(base_price / 100) * 100  # Round to nearest 100
    
    # Security deposit (usually 1-2 months)
    security_deposit = monthly_rent * random.choice([1, 2])
    
    # Advance payment (usually 1-2 months)
    advance_payment = monthly_rent * random.choice([1, 2])
    
    # Minimum lease term
    min_lease = random.choice(["6 months", "1 year", "2 years", "3 months"])
    
    # Random amenities (3-7)
    num_amenities = random.randint(3, 7)
    amenities = ", ".join(random.sample(amenities_pool, num_amenities))
    
    # Random features (4-8)
    num_features = random.randint(4, 8)
    features = ", ".join(random.sample(features_pool, num_features))
    
    # Generate description
    descriptions = [
        f"Beautiful {prop_type.lower()} located in the heart of {location.split(',')[0]}. Perfect for young professionals and students. Near malls, restaurants, and public transportation.",
        f"Modern and spacious {prop_type.lower()} with stunning views. Ideal for those looking for comfort and convenience in Cebu City. Walking distance to IT hubs and commercial areas.",
        f"Cozy {prop_type.lower()} in a prime location. Well-maintained building with friendly management. Great for solo living or couples. Close to schools and hospitals.",
        f"Newly renovated {prop_type.lower()} featuring contemporary design. Strategic location with easy access to major roads. Perfect for city living with all amenities nearby.",
        f"Affordable {prop_type.lower()} with complete facilities. Quiet neighborhood yet close to the bustling city center. Ideal for those who value peace and accessibility.",
        f"Luxury {prop_type.lower()} in an upscale development. Premium finishes and top-notch security. Experience sophisticated urban living at its finest.",
        f"Charming {prop_type.lower()} with a homey atmosphere. Building has excellent maintenance and responsive admin. Near grocery stores, banks, and cafes.",
        f"Well-designed {prop_type.lower()} maximizing space and natural light. Located in a developing area with growing commercial establishments. Great investment opportunity."
    ]
    description = random.choice(descriptions)
    
    # Property title
    title = f"{prop_type} for Rent at {prop_name}"
    
    data.append({
        "Property ID": f"CEBUProp-{str(i+1).zfill(4)}",
        "Property Title": title,
        "Property Name": prop_name,
        "Property Type": prop_type,
        "Location": location,
        "Description": description,
        "Square Meters": sqm,
        "Bedrooms": beds,
        "Bathrooms": baths,
        "Floor Number": floor,
        "Monthly Rent (PHP)": f"₱{monthly_rent:,}",
        "Security Deposit (PHP)": f"₱{security_deposit:,}",
        "Advance Payment (PHP)": f"₱{advance_payment:,}",
        "Minimum Lease Term": min_lease,
        "Amenities": amenities,
        "Property Features": features,
        "Landlord Full Name": landlord_name,
        "Landlord Contact Number": landlord_phone,
        "Landlord Email": landlord_email,
        "Availability Status": random.choice(["Available", "Available", "Available", "Reserved", "For Viewing"]),
        "Date Listed": f"2026-{random.randint(1, 12):02d}-{random.randint(1, 28):02d}"
    })

# Create DataFrame
df = pd.DataFrame(data)

# Save to Excel
output_path = "/home/mike/Desktop/Swipe-app/cebu_property_listings.xlsx"
df.to_excel(output_path, index=False, sheet_name="Property Listings")

print(f"✅ Excel file created successfully!")
print(f"📁 Location: {output_path}")
print(f"📊 Total Properties: {len(df)}")
print(f"\nColumns included:")
for col in df.columns:
    print(f"  - {col}")
