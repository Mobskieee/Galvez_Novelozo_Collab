## Galvez MidTerms — Laravel CRUD for Students and Sections

This is a Laravel application that manages Students and Sections with full CRUD interfaces. It uses Blade views, Eloquent models, and RESTful resource controllers. A SQLite database is included for quick local setup on Windows.

### Key Features
- Students CRUD: list, create, view, edit, delete
- Sections CRUD with validation: unique `sectionCode`, required `sectionName`, integer `capacity`
- Blade views under `resources/views/students` and `resources/views/sections`
- Resource routes (`/students`, `/sections`) registered in `routes/web.php`

---

## Prerequisites (Windows)
- PHP 8.2+
- Composer
- Node.js 18+ and npm (for Vite assets; optional if you use prebuilt CSS/JS)

Verify versions:

```bash
php -v
composer -V
node -v && npm -v
```

## Quick Start
1) Install PHP dependencies

```bash
composer install
```

2) Create environment file

```bash
copy .env.example .env
php artisan key:generate
```

3) Database configuration
- Default is SQLite. A database file exists at `database/database.sqlite`.
- Ensure your `.env` contains:

```env
DB_CONNECTION=sqlite
DB_DATABASE=./database/database.sqlite
```

4) Run migrations

```bash
php artisan migrate
```

5) (Optional) Build frontend assets with Vite

```bash
npm install
npm run build    # or: npm run dev
```

6) Serve the app

```bash
php artisan serve
```

Open `http://127.0.0.1:8000` in your browser.

## Application Structure (relevant parts)
- `app/Models/Student.php` — mass-assignable fields: `studentNumber`, `lname`, `fname`, `mi`, `email`, `contactNumber`
- `app/Models/Section.php` — mass-assignable fields: `sectionCode`, `sectionName`, `description`, `room`, `capacity`
- `app/Http/Controllers/StudentController.php` — resource controller for Students
- `app/Http/Controllers/SectionController.php` — resource controller for Sections with request validation
- `resources/views/students/*` — Blade views for Students CRUD
- `resources/views/sections/*` — Blade views for Sections CRUD
- `routes/web.php` — route definitions

## Routes
Registered in `routes/web.php`:

```php
Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::resource('students', StudentController::class);
Route::resource('sections', SectionController::class);
```

This generates the following endpoints:

- Students
  - GET `/students` (index)
  - GET `/students/create` (create)
  - POST `/students` (store)
  - GET `/students/{student}` (show)
  - GET `/students/{student}/edit` (edit)
  - PUT/PATCH `/students/{student}` (update)
  - DELETE `/students/{student}` (destroy)

- Sections
  - GET `/sections` (index)
  - GET `/sections/create` (create)
  - POST `/sections` (store)
  - GET `/sections/{section}` (show)
  - GET `/sections/{section}/edit` (edit)
  - PUT/PATCH `/sections/{section}` (update)
  - DELETE `/sections/{section}` (destroy)

## Validation (Sections)
Create/Update requests validate:

```php
[
  'sectionCode' => 'required|unique:sections,sectionCode[,ignoreId]',
  'sectionName' => 'required',
  'description' => 'nullable',
  'room' => 'nullable',
  'capacity' => 'required|integer|min:1',
]
```

## Database
Migrations are located in `database/migrations`, including tables for users, jobs/cache (framework defaults), and domain entities:
- `2025_09_05_152536_create_students_table.php`
- `2025_09_13_083649_create_sections_table.php`

To reset the database:

```bash
php artisan migrate:fresh --seed
```

### Seed sample data
This project includes basic seed data for one `User`, two `Sections`, and two `Students` via `database/seeders/DatabaseSeeder.php`.

Run:

```bash
php artisan db:seed
```

## Frontend Assets
- Source files: `resources/css/app.css`, `resources/js/app.js`
- Build/serve with Vite: `npm run dev` (hot reload) or `npm run build`
- Public assets (already built or static): `public/css`, `public/js`

## Screenshots
Add screenshots or GIFs to visually demo the flows. Suggested locations:

```
public/screenshots/students-index.png
public/screenshots/students-create.png
public/screenshots/sections-index.png
```

Embed in this README, for example:

```md
![Students Index](public/screenshots/students-index.png)
```

## Running Tests

```bash
php artisan test
```

## Troubleshooting
- White page or view errors: run `php artisan view:clear && php artisan cache:clear`
- SQLite permission issues: ensure `database/database.sqlite` exists and is writable
- Class not found or autoload issues: run `composer dump-autoload`
- Asset 404s: run `npm run dev` and keep Vite running, or `npm run build` for production assets

## Notes
- There is a secondary Laravel project under `Galvez_Novelozo_Collab/`. This README documents the root app. If you intend to run the collaborative app, refer to its own `README.md` and run commands from that subdirectory.

### Running the collaborative sub-app (`Galvez_Novelozo_Collab/`)

From `Galvez_Novelozo_Collab/`:

```bash
cd Galvez_Novelozo_Collab
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev   # optional for assets
php artisan serve
```

## License
MIT
