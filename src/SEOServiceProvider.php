<?php

namespace LaraZeus\SEO;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use LaraZeus\SEO\Commands\GenerateFaviconsCommand;

class SEOServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->scoped('seo', SEOManager::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'seo');

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateFaviconsCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/seo'),
        ], 'seo-views');

        Blade::directive('seo', function ($expression) {
            return "<?php echo seo()->render($expression); ?>";
        });
    }
}
