---
title: Installation
weight: 1
---

## Prerequisites

This package is built for Laravel and Filament.

## Installation

```bash
composer require lara-zeus/laravel-seo
```

Add the component in your layout `<head>`:

```html
<x-seo::meta />
```

## Usage

Use `seo()` in PHP or `@seo` in Blade to set and render SEO metadata.
