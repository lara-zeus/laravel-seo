<?php

test('values can be modified using modifiers', function () {
    seo()->title(modify: fn (string $title) => $title . ' | LaraZeus');

    seo()->title('About us');

    expect(seo('title'))->toBe('About us | LaraZeus');
});

test('modifiers are applied on values returned from set', function () {
    seo()->title(modify: fn (string $title) => $title . ' | LaraZeus');

    expect(seo(['title' => 'Blog']))->toHaveKey('title', 'Blog | LaraZeus');
});

test('modifiers are not applied on default values', function () {
    seo()->title(modify: fn (string $title) => $title . ' | LaraZeus', default: 'LaraZeus — Web development agency');

    expect(seo('title'))->toBe('LaraZeus — Web development agency');
});

test('modifiers can be bypassed by using the raw method', function () {
    seo()->title(modify: fn (string $title) => $title . ' | LaraZeus');

    seo()->title('About us');

    expect(seo()->get('title'))->toBe('About us | LaraZeus');
    expect(seo()->raw('title'))->toBe('About us');
});
