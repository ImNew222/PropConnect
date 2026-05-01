# Docker Startup Guide

Here is how to run the project whenever you come back to it.

## 1. Start the System
Open your terminal (PowerShell or VS Code terminal) in this folder and run:

```powershell
docker-compose up -d
```
*   Wait about 30 seconds for the container to start.

## 2. Access the Application
Go to your browser and visit:
**[http://localhost:8000](http://localhost:8000)**

## 3. Stop the System
When you are done, run:
```powershell
docker-compose stop
```

---

## Troubleshooting

### If the UI looks broken or "Vite manifest not found"
If you see a blank screen or a "manifest not found" error, it means the assets need to be rebuilt.
Run this command once:
```powershell
docker-compose exec app npm run build
```

### If Database errors occur ("could not find driver")
This usually means the container needs a reset. Run:
```powershell
docker-compose down
docker-compose up -d --force-recreate
```
