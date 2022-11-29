<?php

namespace Orbtall\Intl;

use Illuminate\Support\ServiceProvider;

class IntlServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {

        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('intl.php'),
        ], 'config');

        if (! class_exists('CreateRegionsTable')) {
            $this->publishes([
              __DIR__ . '/../../database/migrations/create_regions_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '1_create_regions_table.php'),
            ], 'migrations');
        }

        if (! class_exists('CreateLanguagesTable')) {
            $this->publishes([
              __DIR__ . '/../../database/migrations/create_languages_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '2_create_languages_table.php'),
            ], 'migrations');
        }

        if (! class_exists('CreateCountriesTable')) {
            $this->publishes([
              __DIR__ . '/../../database/migrations/create_countries_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '3_create_countries_table.php'),
            ], 'migrations');
        }

        if (! class_exists('CreateLocalesTable')) {
            $this->publishes([
              __DIR__ . '/../../database/migrations/create_locales_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '4_create_locales_table.php'),
            ], 'migrations');
        }

        if (! class_exists('CreateIgnoredRoutesTable')) {
            $this->publishes([
              __DIR__ . '/../../database/migrations/create_ignored_routes_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '5_create_ignored_routes_table.php'),
            ], 'migrations');
        }

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['modules.handler', 'modules'];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $packageConfigFile = __DIR__.'/../../config/config.php';

        $this->mergeConfigFrom(
            $packageConfigFile, 'intl'
        );

        $this->registerBindings();

        $this->registerCommands();
    }

    /**
     * Registers app bindings and aliases.
     */
    protected function registerBindings()
    {
        $this->app->singleton(Intl::class, function () {
            return new Intl();
        });

        $this->app->alias(Intl::class, 'intl');
    }

    /**
     * Registers route caching commands.
     */
    protected function registerCommands()
    {
        $this->app->singleton('intlroutecache.cache', Commands\RouteTranslationsCacheCommand::class);
        $this->app->singleton('intlroutecache.clear', Commands\RouteTranslationsClearCommand::class);
        $this->app->singleton('intlroutecache.list', Commands\RouteTranslationsListCommand::class);

        $this->commands([
            'intlroutecache.cache',
            'intlroutecache.clear',
            'intlroutecache.list',
        ]);
    }
}
