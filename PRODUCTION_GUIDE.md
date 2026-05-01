# 🚀 Production Deployment Guide

## Quick Optimization Commands

```bash
# 1. Build assets (minifies CSS/JS)
npm run build

# 2. Laravel optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# 3. Clear old cache (if needed)
php artisan optimize:clear
```

---

## Pre-Deployment Checklist

### ✅ Assets
- [ ] Run `npm run build` (creates minified bundles in `/public/build/`)
- [ ] Check that all images are compressed
- [ ] Use WebP format for images where possible

### ✅ Laravel
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Run cache commands above
- [ ] Generate `APP_KEY` if not set

### ✅ Database
- [ ] Run `php artisan migrate --force`
- [ ] Seed any required data

### ✅ Server
- [ ] Enable Gzip compression
- [ ] Set up SSL/HTTPS
- [ ] Configure CDN for static assets (optional)

---

## File Size Summary

| Type | Before Minify | After Minify (est.) |
|------|--------------|---------------------|
| CSS | ~72 KB | ~20 KB |
| JS | ~41 KB | ~15 KB |
| **Total** | **~113 KB** | **~35 KB** |

---

## Current Optimizations Already Done

✅ **Mapbox lazy loading** - Map only loads when user clicks "Map" view
✅ **Tilequery instead of multiple API calls** - Single request for POIs
✅ **Isochrone API** - Efficient polygon generation
✅ **3D buildings on demand** - Toggle on/off

---

## Recommended Hosting

| Provider | Best For | Notes |
|----------|----------|-------|
| **Vercel** | Frontend | Great for static/Jamstack |
| **Railway** | Laravel | Easy deployment |
| **DigitalOcean** | Full control | App Platform or Droplet |
| **Render** | Simple | Good free tier |

---

## Environment Variables for Production

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_DATABASE=propconnect
DB_USERNAME=your-username
DB_PASSWORD=your-password

# Optional: CDN for assets
ASSET_URL=https://cdn.yourdomain.com
```

---

## Performance Testing Tools

- **Google Lighthouse** - Built into Chrome DevTools (Audit tab)
- **GTmetrix** - https://gtmetrix.com
- **WebPageTest** - https://webpagetest.org

---

## Commands Reference

```bash
# Development
npm run dev          # Start Vite dev server
php artisan serve    # Start Laravel server

# Production Build
npm run build        # Build minified assets

# Laravel Cache
php artisan optimize           # Cache everything
php artisan optimize:clear     # Clear all caches
php artisan config:cache       # Cache config
php artisan route:cache        # Cache routes
php artisan view:cache         # Cache views
```
