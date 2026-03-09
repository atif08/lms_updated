# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Run all tests
php artisan test --compact

# Run a single test file
php artisan test --compact tests/Feature/ExampleTest.php

# Filter by test name
php artisan test --compact --filter=testName

# Format PHP code (run after any PHP changes)
vendor/bin/pint --dirty --format agent

# Start dev server
composer run dev
# or
npm run dev

# Build frontend assets
npm run frontend
```

## Architecture Overview

This is a **Laravel 12 LMS (Learning Management System)** using **Blade templates** (not an SPA). Despite having Inertia and Livewire in `composer.json`, the primary UI is server-rendered Blade views with Yajra DataTables and vanilla JS.

### Namespace / Directory Structure

The codebase uses four top-level namespaces:

- **`App\Admin\*`** (`app/Admin/`) — Admin-facing controllers, DataTables, Forms, and dashboard Blocks.
- **`App\Frontend\*`** (`app/Frontend/`) — Student-facing controllers for courses, assignments, quizzes, attendance.
- **`Domain\*`** (`src/Domain/`) — All Eloquent models, Enums, and Actions organized by domain (Courses, Quizzes, Assignments, Attendance, Calendar, Categories, FileLibrary, Users).
- **`Support\*`** (`src/Support/`) — Shared traits (`GeneratesUniqueSlug`, `StatusChangeable`) and enums.

### Base Classes — Extend These

- **`BaseController`** (`app/Http/Controllers/BaseController.php`) — All controllers extend this. Applies `auth` + `accessibility` middleware, populates `$this->user`, `$this->selected_user`, `$this->current_account`, `$this->accounts`. Use `renderView()` to pass standard view variables and `resJson()` for JSON responses.
- **`BaseForm`** (`app/Admin/Forms/BaseForm.php`) — Admin forms use `kris/laravel-form-builder`. Extend this and implement `buildComponents()`. Use `createForm()` in controllers to instantiate.
- **`DataTableBase`** (`app/Admin/DataTables/DataTableBase.php`) — All admin data tables extend this. Implement `getBaseQuery()` and `getColumnDef()`. Uses Yajra DataTables.
- **`BlockBase`** (`app/Admin/Blocks/BlockBase.php`) — Dashboard report blocks extend this. Implement `getQuery()` and `loadHtml()`. Block IDs and config come from `config('blocks')`.
- **`BaseJob`** (`app/Jobs/BaseJob.php`) — All queued jobs extend this.
- **`BaseAction`** (`app/Actions/BaseAction.php`) — Actions extend this.

### Domain Models

All Eloquent models live in `src/Domain/{DomainName}/Models/`. Key domains:

- **Courses** — `Course`, `Topic`, `Lesson`, `Topicable` (polymorphic pivot), `CourseQuestion`, `CourseAnswer`, `Announcement`
- **Quizzes** — `Quiz`, `QuizSection`, `Question`, `QuestionOption`, `QuizAttempt`, `QuizAttemptAnswer`, `QuizAuthor`, `QuizSectionQuestion`, `QuizQuestion`
- **Assignment** — `Assignment`, `AssignmentUser`, `SubmittedAssignment`, `AssignmentExtendRequest`
- **Attendance** — `Attendance`
- **Users** — `User` (in `Domain\Users\Models\User`) with `HasTypeAttributes` and `HasUserAttributes` traits

### User Hierarchy

The `User` model is self-referential with `parent_id`. User types defined in `src/Domain/Users/Enums/UserTypeEnum.php`: `Admin`, `Buyer`, `Seller`, `Warehouse`, `Developer`.

- `HasTypeAttributes` trait (`src/Domain/Users/Models/UserAttributes/HasTypeAttributes.php`) provides `isAdmin()`, `isSeller()`, etc.
- `HasUserAttributes` trait stores arbitrary per-user JSON preferences in the `user_attributes` table via `getUserAttribute()` / `setUserAttribute()`.

### Routes

Routes live in `routes/web.php` with two main groups:

- `prefix('admin')->middleware(['auth', 'check_user_type'])` — Admin routes
- `middleware('auth.frontend')` — Student-facing routes

### Key Patterns

- **Flash messages**: Use `FlashMessage::success()` / `FlashMessage::error()` (`app/Services/FlashMessage.php`).
- **Accessibility middleware** (`app/Http/Middleware/Accessibility.php`): Runs on every authenticated request — checks `is_active`, logs to `PageVisit`, records response time.
- **Global helpers** (autoloaded from `app/Helpers/shared.php` and `app/Helpers/formatter.php`): `console_log()`, `is_local()`, `get_class_name()`, `parse_date()`, `storage()`, `format_amount()`, `format_percent()`, etc.
- **Route naming**: Routes follow `{prefix}.get.index`, `{prefix}.post.details`, etc.
- **Local packages**: `packages/spatie-laravel-comments` and `packages/laravel-medialibrary-pro` are path-referenced in `composer.json`.

### Directory Highlights

- `app/Admin/Blocks/` — Dashboard report blocks; each block extends `BlockBase`, implements `getQuery()` and `loadHtml()`.
- `app/Admin/DataTables/` — DataTables organized by feature; column types (`amount`, `percent`, `boolean`, `date`, etc.) are handled automatically in `DataTableBase::getData()`.
- `app/Admin/Forms/Fields/` — Custom form field types (CkEditor, MediaLibrary, MultiSelect, etc.).
- `src/Domain/` — All models and domain logic; add new models here, not in `app/Models/`.
- `resources/views/scripts/` — JavaScript partial views included at the bottom of pages.
- `resources/views/data-tables/` — Per-entity DataTable view partials (custom filters, inline edit forms).
- `resources/views/layouts/` — Multiple layout options: `master.blade.php`, `horizontal.blade.php`, `master-without-nav.blade.php`.

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.4.18
- inertiajs/inertia-laravel (INERTIA_LARAVEL) - v2
- laravel/cashier (CASHIER) - v16
- laravel/framework (LARAVEL) - v12
- laravel/prompts (PROMPTS) - v0
- laravel/sanctum (SANCTUM) - v4
- livewire/livewire (LIVEWIRE) - v3
- tightenco/ziggy (ZIGGY) - v2
- laravel/boost (BOOST) - v2
- laravel/breeze (BREEZE) - v2
- laravel/mcp (MCP) - v0
- laravel/pint (PINT) - v1
- laravel/sail (SAIL) - v1
- phpunit/phpunit (PHPUNIT) - v11

## Skills Activation

This project has domain-specific skills available. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

- `livewire-development` — Develops reactive Livewire 3 components. Activates when creating, updating, or modifying Livewire components; working with wire:model, wire:click, wire:loading, or any wire: directives; adding real-time updates, loading states, or reactivity; debugging component behavior; writing Livewire tests; or when the user mentions Livewire, component, counter, or reactive UI.
- `medialibrary-development` — Build and work with spatie/laravel-medialibrary features including associating files with Eloquent models, defining media collections and conversions, generating responsive images, and retrieving media URLs and paths.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

- Laravel Boost is an MCP server that comes with powerful tools designed specifically for this application. Use them.

## Artisan

- Use the `list-artisan-commands` tool when you need to call an Artisan command to double-check the available parameters.

## URLs

- Whenever you share a project URL with the user, you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain/IP, and port.

## Tinker / Debugging

- You should use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly.
- Use the `database-query` tool when you only need to read from the database.
- Use the `database-schema` tool to inspect table structure before writing migrations or models.

## Reading Browser Logs With the `browser-logs` Tool

- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost.
- Only recent browser logs will be useful - ignore old logs.

## Searching Documentation (Critically Important)

- Boost comes with a powerful `search-docs` tool you should use before trying other approaches when working with Laravel or Laravel ecosystem packages. This tool automatically passes a list of installed packages and their versions to the remote Boost API, so it returns only version-specific documentation for the user's circumstance. You should pass an array of packages to filter on if you know you need docs for particular packages.
- Search the documentation before making code changes to ensure we are taking the correct approach.
- Use multiple, broad, simple, topic-based queries at once. For example: `['rate limiting', 'routing rate limiting', 'routing']`. The most relevant results will be returned first.
- Do not add package names to queries; package information is already shared. For example, use `test resource table`, not `filament 4 test resource table`.

### Available Search Syntax

1. Simple Word Searches with auto-stemming - query=authentication - finds 'authenticate' and 'auth'.
2. Multiple Words (AND Logic) - query=rate limit - finds knowledge containing both "rate" AND "limit".
3. Quoted Phrases (Exact Position) - query="infinite scroll" - words must be adjacent and in that order.
4. Mixed Queries - query=middleware "rate limit" - "middleware" AND exact phrase "rate limit".
5. Multiple Queries - queries=["authentication", "middleware"] - ANY of these terms.

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.

## Constructors

- Use PHP 8 constructor property promotion in `__construct()`.
    - `public function __construct(public GitHub $github) { }`
- Do not allow empty `__construct()` methods with zero parameters unless the constructor is private.

## Type Declarations

- Always use explicit return type declarations for methods and functions.
- Use appropriate PHP type hints for method parameters.

<!-- Explicit Return Types and Method Params -->
```php
protected function isAccessible(User $user, ?string $path = null): bool
{
    ...
}
```

## Enums

- Typically, keys in an Enum should be TitleCase. For example: `FavoritePerson`, `BestLake`, `Monthly`.

## Comments

- Prefer PHPDoc blocks over inline comments. Never use comments within the code itself unless the logic is exceptionally complex.

## PHPDoc Blocks

- Add useful array shape type definitions when appropriate.

=== inertia-laravel/core rules ===

# Inertia

- Inertia creates fully client-side rendered SPAs without modern SPA complexity, leveraging existing server-side patterns.
- Components live in `resources/js/Pages` (unless specified in `vite.config.js`). Use `Inertia::render()` for server-side routing instead of Blade views.
- ALWAYS use `search-docs` tool for version-specific Inertia documentation and updated code examples.

# Inertia v2

- Use all Inertia features from v1 and v2. Check the documentation before making changes to ensure the correct approach.
- New features: deferred props, infinite scroll, merging props, polling, prefetching, once props, flash data.
- When using deferred props, add an empty state with a pulsing or animated skeleton.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using the `list-artisan-commands` tool.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

## Database

- Always use proper Eloquent relationship methods with return type hints. Prefer relationship methods over raw queries or manual joins.
- Use Eloquent models and relationships before suggesting raw database queries.
- Avoid `DB::`; prefer `Model::query()`. Generate code that leverages Laravel's ORM capabilities rather than bypassing them.
- Generate code that prevents N+1 query problems by using eager loading.
- Use Laravel's query builder for very complex database operations.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `list-artisan-commands` to check the available options to `php artisan make:model`.

### APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## Controllers & Validation

- Always create Form Request classes for validation rather than inline validation in controllers. Include both validation rules and custom error messages.
- Check sibling Form Requests to see if the application uses array or string based validation rules.

## Authentication & Authorization

- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum, etc.).

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Queues

- Use queued jobs for time-consuming operations with the `ShouldQueue` interface.

## Configuration

- Use environment variables only in configuration files - never use the `env()` function directly outside of config files. Always use `config('app.name')`, not `env('APP_NAME')`.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== laravel/v12 rules ===

# Laravel 12

- CRITICAL: ALWAYS use `search-docs` tool for version-specific Laravel documentation and updated code examples.
- This project upgraded from Laravel 10 without migrating to the new streamlined Laravel file structure.
- This is perfectly fine and recommended by Laravel. Follow the existing structure from Laravel 10. We do not need to migrate to the new Laravel structure unless the user explicitly requests it.

## Laravel 10 Structure

- Middleware typically lives in `app/Http/Middleware/` and service providers in `app/Providers/`.
- There is no `bootstrap/app.php` application configuration in a Laravel 10 structure:
    - Middleware registration happens in `app/Http/Kernel.php`
    - Exception handling is in `app/Exceptions/Handler.php`
    - Console commands and schedule register in `app/Console/Kernel.php`
    - Rate limits likely exist in `RouteServiceProvider` or `app/Http/Kernel.php`

## Database

- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 12 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models

- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.

=== livewire/core rules ===

# Livewire

- Livewire allows you to build dynamic, reactive interfaces using only PHP — no JavaScript required.
- Instead of writing frontend code in JavaScript frameworks, you use Alpine.js to build the UI when client-side interactions are required.
- State lives on the server; the UI reflects it. Validate and authorize in actions (they're like HTTP requests).
- IMPORTANT: Activate `livewire-development` every time you're working with Livewire-related tasks.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== phpunit/core rules ===

# PHPUnit

- This application uses PHPUnit for testing. All tests must be written as PHPUnit classes. Use `php artisan make:test --phpunit {name}` to create a new test.
- If you see a test using "Pest", convert it to PHPUnit.
- Every time a test has been updated, run that singular test.
- When the tests relating to your feature are passing, ask the user if they would like to also run the entire test suite to make sure everything is still passing.
- Tests should cover all happy paths, failure paths, and edge cases.
- You must not remove any tests or test files from the tests directory without approval. These are not temporary or helper files; these are core to the application.

## Running Tests

- Run the minimal number of tests, using an appropriate filter, before finalizing.
- To run all tests: `php artisan test --compact`.
- To run all tests in a file: `php artisan test --compact tests/Feature/ExampleTest.php`.
- To filter on a particular test name: `php artisan test --compact --filter=testName` (recommended after making a change to a related file).

=== spatie/laravel-medialibrary rules ===

## Media Library

- `spatie/laravel-medialibrary` associates files with Eloquent models, with support for collections, conversions, and responsive images.
- Always activate the `medialibrary-development` skill when working with media uploads, conversions, collections, responsive images, or any code that uses the `HasMedia` interface or `InteractsWithMedia` trait.

</laravel-boost-guidelines>
