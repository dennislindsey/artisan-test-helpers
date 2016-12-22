<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 12/18/16
 * Time: 7:49 PM
 */

namespace DennisLindsey\ArtisanTestHelpers\Commands;

use Illuminate\Console\GeneratorCommand;

class UnitTestMakeCommand extends AbstractTestMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:unittest {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new unit test class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if (file_exists(base_path('/tests/stubs/unit.stub'))) {
            return base_path('/tests/stubs/unit.stub');
        } elseif (file_exists(__DIR__ . '/../stubs/unit.stub')) {
            return __DIR__ . '/../stubs/unit.stub';
        }

        return base_path('/vendor/laravel/framework/src/Illuminate/Foundation/Console/stubs/test.stub');
    }

    /**
     * Get the destination class path.
     *
     * @param  string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace($this->laravel->getNamespace(), '', $name);

        return $this->laravel['path.base'] . '/tests/unit/' . str_replace('\\', '/', $name) .
            (stripos(strrev($name), 'tseT') === 0 ? '' : 'Test') . '.php';
    }

}
