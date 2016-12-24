<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 12/18/16
 * Time: 7:49 PM
 */

namespace DennisLindsey\ArtisanTestHelpers\Commands;

use Illuminate\Console\GeneratorCommand;

abstract class AbstractMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new test class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Test';

    /**
     * Parse the name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function parseName($name)
    {
        $name = ucwords($name);
        return parent::parseName($name);
    }

    /**
     * Build the class with the given name.
     *
     * @param  string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub      = $this->files->get($this->getStub());
        $className = $name . (stripos(strrev($name), strrev('Test')) === 0 ? '' : 'Test');

        return $this->replaceNamespace($stub, $name)->replaceFirstMethod($stub, $name)->replaceClass($stub, $className);
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

        $stub = str_replace('{METHODNAME}', $methodName, $stub);

        return $this;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $class = str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace('{CLASSNAME}', $class, $stub);
    }
}
