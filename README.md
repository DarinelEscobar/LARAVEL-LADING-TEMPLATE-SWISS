# Web Backup

Aplicación Laravel 10 con una landing page de estilo suizo y un panel de administración minimalista.

Este README breve muestra cómo instalar, ejecutar y probar la aplicación en un entorno de desarrollo (Windows / PowerShell y Linux/macOS).

## Requisitos
- PHP 8.1+
- Composer
- Node.js (v16+) y npm
- MySQL/MariaDB (o usar SQLite para tests locales)

## Instalación rápida (Windows - PowerShell)
1. Copiar el fichero de entorno y configurarlo:

copy .env.example .env

2. Instalar dependencias PHP y JS:

composer install
npm install

3. Generar la APP key:

php artisan key:generate

4. Migrar y seedear la base de datos (modo desarrollo):

php artisan migrate --seed

5. Levantar servidores de desarrollo:

php artisan serve
npm run dev

Para producción, compilar assets con:

npm run build

## Estructura principal
- Código backend: `app/` (Controllers, Models, Livewire components)
- Vistas Blade: `resources/views/`
- Assets: `resources/css/`, `resources/js/` (Vite)
- Rutas: `routes/web.php`, `routes/api.php`

Para más detalles sobre organización de carpetas, consultar `AGENTS.md`.

## Autenticación y permisos
- El dashboard de administrador está protegido por middleware `auth`, `status` y `role:1`.
- Usuario administrador por defecto (seed): `admin@test.com` / `password` (si el seeder lo provee).

## Tests
Se utilizan Pest/PHPUnit para la suite de tests. En Windows/PowerShell es recomendable invocar el binario de Pest a través de PHP para asegurar que se use el intérprete correcto y ver salida coloreada.

Comando recomendado (PowerShell / Windows):

php ./vendor/bin/pest --colors=always

Alternativa (ejecutar PHPUnit vía Artisan):

php artisan test

Nota: Si los tests fallan por falta de datos referenciales (por ejemplo `status` o `roles`), vuelva a ejecutar migraciones y seeders para el entorno de testing o asegúrese de que los factories crean las relaciones necesarias.

## Comandos útiles
- Ver rutas registradas:

php artisan route:list

- Reconstruir base de datos de desarrollo:

php artisan migrate:fresh --seed

## Sugerencias y siguientes pasos
- Añadir en `composer.json` un script conveniente para tests (opcional):

"scripts": {
  "test:pest": "php ./vendor/bin/pest --colors=always"
}

- Para un entorno de CI es buena práctica usar SQLite en memoria o una BD de pruebas aislada y asegurarse de ejecutar los seeders mínimos que necesite la suite.

Si quieres, adapto este README para que sea bilingüe (ES/EN) o añado secciones específicas para contributors y despliegue.
