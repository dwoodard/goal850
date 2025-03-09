# Forge deployment

```bash
#!/usr/bin/env bash
set -e  # Exit immediately if a command exits with a non-zero status (fail fast)

# 1. Navigate to the project directory
cd /home/forge/goal850.com || exit 1

# 2. Pull the latest code from the Git repository (using the current branch set in Forge)
git pull origin "$FORGE_SITE_BRANCH"

# 3. Install PHP dependencies without dev packages, optimized for production
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# 4. Run database migrations (use --force to suppress confirmation prompt)
php artisan migrate --force

# 5. Clear and optimize application caches (config, route, view, etc.)
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 6. Install Node.js dependencies and build frontend assets with Vite
npm install
npm run build

# 7. Run Statamic CMS updates (if applicable to your project)
php please update

# 8. (Optional) Exit maintenance mode if it was enabled earlier
# php artisan up

echo "✅ Deployment completed successfully 😊 "
```
