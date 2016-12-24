<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 12/23/2016
 * Time: 5:26 PM
 */

namespace DennisLindsey\ArtisanTestHelpers\Commands;

use Illuminate\Console\GeneratorCommand;

class FactoryMakeCommand extends AbstractMakeCommand
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
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Factory';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if (file_exists(database_path('/stubs/factory.stub'))) {
            return database_path('/stubs/factory.stub');
        } elseif (file_exists(__DIR__ . '/../stubs/factory.stub')) {
            return __DIR__ . '/../stubs/factory.stub';
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

        return $this->laravel['path.database'] . '/factories/' . str_replace('\\', '/', $name) .
        (stripos(strrev($name), strrev('Factory')) === 0 ? '' : 'Factory') . '.php';
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

}
