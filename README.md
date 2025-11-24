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

## Folder Structure

The project follows a component-based architecture to separate concerns (Header, Main Content, Footer) for both the Landing Page and the Admin Dashboard.

### `resources/views`

-   **`layouts/`**: Contains the main layout files.
    -   `landing-page.blade.php`: Layout for the public landing page.
    -   `admin.blade.php`: Layout for the admin dashboard.
    -   `authentication.blade.php`: Layout for login/register pages.

-   **`components/`**: Reusable Blade components.
    -   **`landing/`**: Components specific to the landing page (e.g., `header`, `footer`, `hero`, `showcase`).
    -   **`admin/`**: Components specific to the admin dashboard (e.g., `header`, `footer`).
    -   **`ui/`**: General UI components (buttons, inputs, cards).

-   **`pages/`**: Main page views that extend layouts.
    -   `dashboard.blade.php`: The main admin dashboard page.

-   **`livewire/`**: Livewire components for dynamic functionality.
    -   `dashboard/home.blade.php`: The main content of the landing page.

### Component Usage

Both the Landing Page and Admin Dashboard layouts are structured as follows:

1.  **Header**: `<x-landing.header />` or `<x-admin.header />`
2.  **Main Content**: `@yield('content')` (which may contain Livewire components)
3.  **Footer**: `<x-landing.footer />` or `<x-admin.footer />`

This ensures a consistent structure and makes it easy to maintain or swap out parts of the UI.


## Testing
Run the suite with `php artisan test`.
