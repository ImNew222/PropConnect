#!/bin/bash

# PropConnect Docker Setup Script for Fresh Machines

echo "Starting Setup..."

# 1. Copy .env if not exists
if [ ! -f .env ]; then
    echo "Copying .env.example to .env..."
    cp .env.example .env
else
    echo ".env file exists."
fi

# 2. Install Composer Dependencies (using temporary container)
# This bootstraps the project so we can use Sail
echo "Installing PHP dependencies..."

# MSYS_NO_PATHCONV prevents Git Bash from converting Unix paths to Windows paths
MSYS_NO_PATHCONV=1 docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# 3. Start Sail (Docker Containers)
echo "Starting Docker containers..."
./vendor/bin/sail up -d

# 4. Generate App Key
echo "Generating Application Key..."
./vendor/bin/sail artisan key:generate

# 5. Run Migrations
echo "Running Database Migrations..."
# Wait a bit for MySQL to be ready
echo "   (Waiting 10s for DB to initialize...)"
sleep 10
./vendor/bin/sail artisan migrate

# 6. Install NPM Dependencies & Build Assets
echo "Installing Node dependencies..."
./vendor/bin/sail npm install
./vendor/bin/sail npm run build

echo "Setup Complete!"
echo "You can access the site at: http://localhost"
