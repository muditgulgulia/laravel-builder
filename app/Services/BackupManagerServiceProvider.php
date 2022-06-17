<?php

namespace App\Services;

use Illuminate\Support\ServiceProvider;

class BackupManagerServiceProvider extends ServiceProvider
{
    /**
     * Where the route file lives, both inside the package and in the app (if overwritten).
    //     *
    //     * @var string
    //     */
//    public $separators = PHP_OS == 'WINNT' ? '\\' : '/';
//
//    public $routeFilePath = $this->separators.'routes'.$this->separators.'backpack\\backupmanager.php';
//    /**
//     * Indicates if loading of the provider is deferred.
//     *
//     * @var bool
//     */
//    protected $defer = false;
//
//    /**
//     * Perform post-registration booting of services.
//     *
//     * @return void
//     */
//    public function boot()
//    {
//        // use the vendor configuration file as fallback
//        $this->mergeConfigFrom(
//            config_path() . '\\laravel-backup.php', 'larainit.backupmanager'
//        );
//        // LOAD THE VIEWS
//        // - first the published/overwritten views (in case they have any changes)
//        $this->loadViewsFrom(resource_path('views\\vendor\\backpack\\backupmanager'), 'larainit');
//        // - then the stock views that come with the package, in case a published view might be missing
//        $this->loadViewsFrom(realpath(resource_path() . '\\views'), 'backupmanager');
//        // publish config file
//        $this->publishes([config_path() . '\\laravel-backup.php' => config_path('laravel-backup.php')], 'config');
//        // publish lang files
////        $this->publishes([__DIR__.'/resources/lang' => resource_path('lang/vendor/backpack')], 'lang');
//        // publish the views
//        $this->publishes([resource_path() . '\\views' => resource_path('views\\admin\\backup\\backup')], 'views');
//    }
//
//    /**
//     * Register any package services.
//     *
//     * @return void
//     */
//    public function register()
//    {
//        $this->setupRoutes($this->app->router);
//        // use this if your package has a config file
//        config([
//            'config/laravel-backup.php',
//        ]);
//    }
//
//    /**
//     * Define the routes for the application.
//     *
//     * @param \Illuminate\Routing\Router $router
//     *
//     * @return void
//     */
//    public function setupRoutes(Router $router)
//    {
//        // by default, use the routes file provided in vendor
//        $routeFilePathInUse = base_path() . $this->routeFilePath;
//        // but if there's a file with the same name in routes/backpack, use that one
//        if (file_exists(base_path() . $this->routeFilePath)) {
//            $routeFilePathInUse = base_path() . $this->routeFilePath;
//        }
//        $this->loadRoutesFrom($routeFilePathInUse);
//    }
}