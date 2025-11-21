# Web Backup

Laravel 10 application with a Swiss-inspired landing page and a minimalist admin dashboard. Auth flows, password recovery, and status management are powered by Livewire 3, Blade components, and TailwindCSS with anime.js-driven motion.

## Stack
- Laravel 10 (PHP 8.1+), MySQL/MariaDB, Composer
- Livewire 3 for auth and dashboard UI (`app/Livewire`), Blade layouts in `resources/views/layouts`
- TailwindCSS 3.4, Flowbite, and anime.js via Vite (`resources/css/app.css`, `resources/js/app.js`, `resources/js/landing-page.js`)
- Icon sets: Lucide and Heroicons Blade components

### Main tools
- **Anime.js** → included via Vite as a vanilla JS module
- **Livewire components** → auth and dashboard flows under `app/Livewire`
- **Lucide / Heroicons** → rendered through Blade icon packages
- **TailwindCSS** → already configured in the Laravel project

## Getting started
1) Copy env and configure database: `cp .env.example .env`  
2) Install PHP deps: `composer install`  
3) Generate key: `php artisan key:generate`  
4) Run migrations and seeders: `php artisan migrate --seed`  
5) Install JS deps: `npm install`  
6) Dev servers: `php artisan serve` and `npm run dev` (Vite)

For a production asset build, run `npm run build`.

## Authentication
- Login at `/login`; admin dashboard at `/dashboard` (middleware: `auth`, `status`, `role:1`)
- Seeded admin user: `admin@test.com` / `password`
- Password reset flow uses `password_reset_tokens` with Livewire components in `app/Livewire/Auth`

## Project layout
- Pages in `resources/views/pages`; reusable UI in `resources/views/components/{ui,landing}`; partials in `resources/views/partials`
- Landing page content comes from `app/Livewire/Dashboard/Home.php` and `resources/views/livewire/dashboard/home.blade.php`
- Admin dashboard view is `resources/views/pages/admin.blade.php` rendered by `App\Http\Controllers\Admin\AdminController@dashboard`, showing seeded status records

## Testing
Run the suite with `php artisan test`.
