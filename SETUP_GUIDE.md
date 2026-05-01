# PropConnect - Docker Setup Guide 🚀

This guide will help you run PropConnect on your laptop using Docker Desktop.

---

## Prerequisites

✅ **Docker Desktop** installed and running on Windows  
✅ **Git** installed  
✅ **Internet connection** (for Supabase cloud database)

---

## Step 1: Clone the Repository

Open **PowerShell** or **Command Prompt** and run:

```bash
git clone https://github.com/YOUR_USERNAME/Swipe-app.git
cd Swipe-app
```

---

## Step 2: Create the .env File

The `.env` file contains all your API keys and is not included in Git.

**Option A: Copy from .env.example (Recommended)**
```bash
copy .env.example .env
```

**Option B: Create manually**
Create a file named `.env` in the project root with this content:

```env
APP_NAME=PropConnect
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=your-supabase-host.pooler.supabase.com
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
FILESYSTEM_DISK=local

MAIL_MAILER=resend
MAIL_FROM_ADDRESS="onboarding@resend.dev"
RESEND_API_KEY=your_resend_api_key
MAPBOX_ACCESS_TOKEN=your_mapbox_access_token
VITE_APP_NAME="${APP_NAME}"
```

---

## Step 3: Transfer Uploaded Files (Images)

If you have property images, copy the `storage/app/public` folder from your PC to the laptop.

On your **PC**, zip the folder:
```bash
# Linux/Mac
zip -r storage-files.zip storage/app/public
```

On your **laptop**, extract to the same location in the project.

---

## Step 4: Build and Run with Docker

Make sure Docker Desktop is running, then:

```bash
# Build the Docker image (first time takes 5-10 minutes)
docker-compose build

# Start the application
docker-compose up -d
```

---

## Step 5: Generate Application Key (if needed)

If you get an "APP_KEY" error:

```bash
docker-compose exec app php artisan key:generate
```

---

## Step 6: Create Storage Link

This links the storage folder for images:

```bash
docker-compose exec app php artisan storage:link
```

---

## Step 7: Run Migrations (if database is empty)

```bash
docker-compose exec app php artisan migrate
```

---

## Step 8: Access the Application

Open your browser and go to:

🌐 **http://localhost:8000**

---

## Common Commands

| Command | Description |
|---------|-------------|
| `docker-compose up -d` | Start the app in background |
| `docker-compose down` | Stop the app |
| `docker-compose logs -f` | View logs |
| `docker-compose exec app bash` | Enter the container |
| `docker-compose build --no-cache` | Rebuild from scratch |

---

## Troubleshooting

### "Could not connect to database"
- Make sure you have internet connection (Supabase is cloud-hosted)
- Check if the `.env` file exists and has correct credentials

### "Permission denied" on storage
```bash
docker-compose exec app chmod -R 777 storage bootstrap/cache
```

### "Vite manifest not found"
The build runs automatically in Docker. If it fails:
```bash
docker-compose exec app npm run build
```

### CPU at 100%
Docker on Windows can be resource-heavy. In Docker Desktop:
1. Go to Settings → Resources
2. Limit CPU to 2 cores
3. Limit Memory to 4GB

---

## API Keys Reference

| Service | Location | Purpose |
|---------|----------|---------|
| **Supabase** | `.env` (DB_*) | PostgreSQL database |
| **Firebase** | `messages/*.blade.php` | Real-time chat |
| **Mapbox** | `.env` | Maps display |
| **Resend** | `.env` | Email sending |

---

## Quick Start Summary

```bash
# 1. Clone
git clone https://github.com/YOUR_USERNAME/Swipe-app.git
cd Swipe-app

# 2. Create .env
copy .env.example .env

# 3. Build & Run
docker-compose build
docker-compose up -d

# 4. Setup storage
docker-compose exec app php artisan storage:link

# 5. Open browser
# http://localhost:8000
```

---

**Good luck with your presentation! 🎉**
