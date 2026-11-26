---
name: zeus-laravel-seo
description: Manage HTML title, OpenGraph, Twitter card, canonical, and social image meta tags in Laravel using Lara Zeus Laravel SEO.
---

# Lara Zeus Laravel SEO

## Overview & Requirements
`lara-zeus/laravel-seo` provides `SEOManager`, the `seo()` helper, the `@seo` Blade directive, and the `<x-seo::meta />` component for configuring SEO metadata across service providers, controllers, and Blade views.

- **Package**: `lara-zeus/laravel-seo` (Free / MIT)
- **Requirements**: PHP `^8.2`, `illuminate/support` `^12.0 || ^13.0`, `illuminate/view` `^12.0 || ^13.0`

## Installation
```bash
composer require lara-zeus/laravel-seo
```

Add `<x-seo::meta />` inside your layout's `<head>`:

```html
<head>
    <x-seo::meta />
</head>
```

## Configuration & Migrations
There is no package config file and no database migrations. To customize the Blade templates, publish views:

```bash
php artisan vendor:publish --tag=seo-views
```

For Flipp or Previewify signed social images, add keys to `config/services.php`:
- `services.flipp.key` (`FLIPP_KEY`)
- `services.previewify.key` (`PREVIEWIFY_KEY`)

## Filament Panel Registration
None. This is a Laravel Blade/HTTP package without a Filament `Plugin` class.

## Core Usage

### Defaults & Modifiers (e.g., `AppServiceProvider::boot()`)
```php
seo()
    ->site('My App')
    ->title(
        default: 'My App — Welcome',
        modify: fn (string $title) => $title . ' | My App',
    )
    ->description(default: 'Default site description')
    ->twitter()
    ->twitterSite('@myapp')
    ->withUrl();
```

### Setting Tags in Controllers or Views
```php
// PHP
seo()
    ->title($post->title)
    ->description($post->excerpt)
    ->image(asset('images/post.png'))
    ->tag('article:published_time', $post->published_at->toIso8601String());
```

```blade
{{-- Blade directive --}}
@seo(['title' => $page->title, 'description' => $page->excerpt])
@seo('title', 'Custom Title') {{-- sets and echoes --}}
@seo('title') {{-- echoes --}}
```

### Extensions, Canonical URL, Flipp & Previewify
- `seo()->withUrl()` sets `og:url` and `<link rel="canonical">` from `request()->url()`.
- `seo()->favicon()` enables `favicon.ico` and `favicon.png` link tags.
- `seo()->extension('facebook', view: 'components.seo-facebook')` registers custom extension components (disable via `seo()->extension('facebook', false)`).
- `seo()->flipp('blog', 'template-id')` registers a Flipp template; `seo()->flipp('blog', ['title' => '...'])` sets `image` to the signed URL.
- `seo()->previewify('blog', 24)` registers a Previewify template; `seo()->previewify('blog', ['title' => '...'])` sets `image` (keys are auto-prefixed with `previewify:`).

## Common Pitfalls & Anti-Patterns
- **Forgetting `<x-seo::meta />`**: Metadata set via `seo()` will not be rendered unless `<x-seo::meta />` is placed in `<head>`.
- **Expecting Twitter tags without enabling**: Twitter card tags require `seo()->twitter()` or setting a `twitter.*` value (e.g., `seo()->twitterTitle(...)`).
- **Publishing non-existent config**: Only `--tag=seo-views` exists; do not run `vendor:publish` for config or migrations.
