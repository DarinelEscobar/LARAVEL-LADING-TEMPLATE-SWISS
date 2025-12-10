# Repository Guidelines

## Project Structure & Module Organization
- Backend: `app/Http/Controllers`, `app/Models`, `app/Livewire` (sections via `$section` or Livewire components); middleware in `app/Http/Kernel.php`.
- Frontend: Blade layouts in `resources/views/layouts`; pages in `resources/views/pages`; Livewire views under `resources/views/livewire`; reusable UI parts in `resources/views/components/ui`; landing components in `resources/views/components/landing`.
- Assets: Tailwind/JS entries in `resources/css/app.css`, `resources/js/app.js`, `resources/js/landing-page.js`; Vite config in `vite.config.js`. Fonts/colors/animation utilities live alongside Tailwind tokens in `app.css`.
- Data: migrations/seeders in `database/`; public assets in `public/`; caches/logs in `storage/`.
- Routing: `routes/web.php` for web (auth/status/role guarded); API routes in `routes/api.php`. Admin dashboard is `GET /dashboard` (middleware `auth`, `status`, `role:1`).

## Build, Test, and Development Commands
- `npm run dev` - Vite dev server for assets.
- `npm run build` - production asset build (CSS/JS bundles, including anime.js entry).
- `php artisan serve` - run Laravel app locally.
- `php artisan migrate --seed` - migrate and seed DB.
- `php artisan test` - run PHPUnit test suite.
- `php artisan l5-swagger:generate` - regenerate the OpenAPI spec (`storage/api-docs/api-docs.json`) after you touch annotations.

## UI Toolkit & Icons
- TailwindCSS 3.4 with custom CSS variables in `resources/css/app.css` for Swiss minimalist palette and glass effects.
- Anime.js imported in `resources/js/landing-page.js` for page animations; attach via `@vite('resources/js/landing-page.js')`.
- Blade component sets: `x-ui.*` (button/card/input/label/textarea) and `x-landing.*` (header/hero/work/showcase/contact/footer) to mirror the React template.
- Icons: Lucide via `mallardduck/blade-lucide-icons` (`<x-lucide-* />`) and Heroicons via `blade-ui-kit/blade-heroicons` (`<x-heroicon-o-*>`).
- **Laravel Blueprint**: Used for rapid code generation (Models, Migrations, Controllers). Use `draft.yaml` for defining new components.

## Coding Style & Naming Conventions
- PSR-12 / Laravel defaults; controllers end with `Controller`, models singular StudlyCase, Livewire class Studly with kebab-case include.
- Routes: kebab-case paths, dot-notated names (e.g., `route('forget.password')`); protect admin routes with `auth`, `status`, `role:1`.
- Views extend a layout; page shells live in `resources/views/pages`. Prefer shared UI via components instead of inline markup.
- Tables plural, lowercase (`status_types`); columns in English. Use dependency injection; keep controllers thin.

## Testing Guidelines
- Framework: PHPUnit (see `phpunit.xml`). Place HTTP/db flows in `tests/Feature`, pure logic in `tests/Unit`.
- Name tests by intent: `test_guest_cannot_access_dashboard`.
- Use factories and `RefreshDatabase` where needed. Run `php artisan test` before merging.

## Commit & Pull Request Guidelines
- Commits: imperative, present tense (e.g., `Add admin status table`). Include rationale for non-trivial changes.
- PRs: describe behavior changes, link issues, note migrations/seeders, and add screenshots/GIFs for UI updates. Mention test command results.

## Security & Access Notes
- Admin dashboard and related admin routes require `auth`, `status`, and `role:1`.
- Logout via `route('logout')` (POST). Keep new admin endpoints inside the guarded middleware group.

## Laravel Blueprint Usage (Code Generation Rules)

- **Single Source of Truth**: All models, controllers, and relationships MUST be stacked in a single `draft.yaml`. Never replace existing entries.
- **Do Not Overwrite**: When adding a new resource (e.g., Product), append it under `models:` and `controllers:` instead of removing previous ones (e.g., User).
- **Incremental Builds Only**:
  - Always commit current work before running:
    ```
    php artisan blueprint:build
    ```
  - Blueprint may overwrite controllers, requests, policies, and routes.
- **Relationships**:
  - Define relationships directly in `draft.yaml` (e.g., `belongsTo`, `hasMany`) instead of editing models manually afterward.
- **Regeneration Policy**:
  - Regeneration is allowed only when:
    - Schema changes are intentional
    - Git state is clean
- **No Manual Edits to Generated Files**:
  - Do not manually edit:
    - Generated Models
    - Migrations
    - Form Requests
    - Resource Controllers
  - If behavior must change, update `draft.yaml` and re-run Blueprint.
- **File Ownership**:
  - `draft.yaml` owns:
    - Database schema
    - Model structure
    - Form request validation
    - Resource controller shape
- **Testing Requirement**:
  - After every Blueprint build:
    ```
    php artisan test
    ```


## Folder Structure

- resources/views/layouts: Main layouts (landing, admin, auth).
- resources/views/components: Reusable components.
  - landing: Landing page specific.
  - admin: Admin dashboard specific.
  - ui: General UI.
- resources/views/pages: Full page views.
- resources/views/livewire: Livewire components.
- `app/OpenApi`: Holds swagger-php annotations (`OpenApiSpec`, schema classes) that seed the generated docs. Keep new API-specific annotations inside `app/Http/Controllers/Api` or this folder so they are picked up by the scanner.

## API Documentation
- L5 Swagger is installed; generated UI lives at `GET /dev/api-docs` and JSON at `GET /dev/api-docs.json`. Both routes require `web`, `auth`, `status`, `role:1`.
- The base contract is defined in `app/OpenApi/OpenApiSpec.php` and reusable schemas (e.g., `AuthenticatedUser`) live beside it. Add new schemas there or inline on controllers.
- `app/OpenApi/Controllers/UserCrud.php` and `app/OpenApi/Controllers/ProductCrud.php` hold documentation-only annotations for the admin/user CRUD APIs—keep them in sync with any future API routes.
- Guarded API controllers belong under `app/Http/Controllers/Api`. Annotate every endpoint with swagger-php docblocks so `php artisan l5-swagger:generate` keeps `storage/api-docs/api-docs.json` in sync.
- Update `.env` or environment secrets if a different docs host is needed (`L5_SWAGGER_CONST_HOST`, `L5_SWAGGER_GENERATE_ALWAYS`).
- Local-only helper: `/dev/api-docs/auto-auth` logs in the first active `role_id=1` admin, issues a Sanctum token, and the Swagger UI shows a “Auto login & authorize” button that calls it. Keep this endpoint disabled in production (controller guards via `App::environment`).
