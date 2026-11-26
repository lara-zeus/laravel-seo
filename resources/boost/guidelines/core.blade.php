## Lara Zeus Laravel SEO (`lara-zeus/laravel-seo`)

A lightweight, extensible Laravel SEO meta-tag manager (forked from `archtechx/laravel-seo`) supporting `<title>`, OpenGraph, Twitter cards, canonical URLs, custom extensions, Flipp, and Previewify.

### Key Classes, Helpers & Directives
- Manager: `LaraZeus\SEO\SEOManager` (bound as scoped `'seo'` in `LaraZeus\SEO\SEOServiceProvider`)
- Helper: `seo(string|array|null $key = null)` (`src/helpers.php`)
- Blade Component: `<x-seo::meta />`
- Blade Directive: `@seo(...)` (delegates to `seo()->render(...)`)
- Publishable views tag: `seo-views` (no config file or migrations; no Filament `Plugin` class).

### Rules & Anti-Patterns
- **Always include `<x-seo::meta />` in `<head>`**: Setting values via `seo()` or `@seo` has no HTML output unless `<x-seo::meta />` is rendered in your layout.
- **Remember `'seo'` is scoped per request/Octane lifecycle**: `SEOServiceProvider` uses `$this->app->scoped('seo', SEOManager::class)`. Set global defaults in a service provider's `boot()` or middleware, and per-page tags in controllers/views.
- **Twitter and Favicon extensions are opt-in**: Call `seo()->twitter()` (or set any `twitter.*` key) and `seo()->favicon()` to render their meta/link tags.
- **Do not assume a config file or Artisan command exists**: `SEOServiceProvider` publishes only `seo-views`; Flipp (`services.flipp.key`) and Previewify (`services.previewify.key`) read from `config/services.php`.
