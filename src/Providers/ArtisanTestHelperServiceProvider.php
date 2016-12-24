<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 12/21/16
 * Time: 9:01 PM
 */

namespace DennisLindsey\ArtisanTestHelpers\Providers;

use DennisLindsey\ArtisanTestHelpers\Commands\FactoryMakeCommand;
use DennisLindsey\ArtisanTestHelpers\Commands\FeatureTestMakeCommand;
use DennisLindsey\ArtisanTestHelpers\Commands\UnitTestMakeCommand;
use Illuminate\Support\ServiceProvider;

class ArtisanTestHelperServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../stubs/tests' => base_path('/tests/stubs/'),
            __DIR__ . '/../stubs/database' => database_path('/stubs/'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                FeatureTestMakeCommand::class,
                UnitTestMakeCommand::class,
                FactoryMakeCommand::class,
            ]);
        }
    }
}
