<?php

namespace Orbas\Util\Console;

use Illuminate\Console\GeneratorCommand;

class PresenterMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'util:make:presenter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new presenter classes';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Presenter';
    
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/presenter.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Presenters';
    }
}
