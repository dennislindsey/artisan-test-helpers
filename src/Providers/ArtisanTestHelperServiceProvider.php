<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 12/21/16
 * Time: 9:01 PM
 */

namespace DennisLindsey\ArtisanTestHelpers\Providers;

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
            __DIR__ . '/../stubs' => base_path('/tests/stubs/'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                FeatureTestMakeCommand::class,
                UnitTestMakeCommand::class,
            ]);
        }
    }
}
