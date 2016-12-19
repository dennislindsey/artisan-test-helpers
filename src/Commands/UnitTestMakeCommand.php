<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 12/18/16
 * Time: 7:49 PM
 */

namespace DennisLindsey\ArtisanTestHelpers\Commands;

use Illuminate\Console\GeneratorCommand;

class UnitTestMakeCommand extends GeneratorCommand
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
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Test';

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

        return $this->laravel['path.base'] . '/tests/feature/' . str_replace('\\', '/', $name) .
            (stripos(strrev($name), 'tseT') === 0 ? '' : 'Test') . '.php';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceFirstMethod($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Build the first stubbed method's name
     *
     * @param $stub
     * @param $name
     * @return $this
     */
    protected function replaceFirstMethod(&$stub, $name)
    {
        $methodName = 'test' . str_replace($this->getNamespace($name) . '\\', '', $name);

        $stub = str_replace('dummyTestMethod', $methodName, $stub);

        return $this;
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
    }
}