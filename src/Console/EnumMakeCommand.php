<?php

namespace Orbas\Util\Console;

use Illuminate\Console\GeneratorCommand;

class EnumMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'util:make:enum';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new enum classes';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Enum';
    
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/enum.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Enums';
    }
}
