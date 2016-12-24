<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 12/23/2016
 * Time: 5:26 PM
 */

namespace DennisLindsey\ArtisanTestHelpers\Commands;

use Illuminate\Console\GeneratorCommand;

class FactoryMakeCommand extends AbstractTestMakeCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:factory {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model factory class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if (file_exists(database_path('/stubs/feature.stub'))) {
            return database_path('/stubs/feature.stub');
        } elseif (file_exists(__DIR__ . '/../stubs/feature.stub')) {
            return __DIR__ . '/../stubs/feature.stub';
        }

        return '';
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

        return $this->laravel['path.database'] . '/feature/' . str_replace('\\', '/', $name) .
        (stripos(strrev($name), 'yrotcaF') === 0 ? '' : 'Factory') . '.php';
    }

}
