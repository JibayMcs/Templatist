<?php

namespace Templatist;

use Templatist\Console\Commands\MakeTemplateBasedView;
use Illuminate\Support\ServiceProvider;


class VoyagerServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->registerConsoleCommands();
        }
    }

    /**
     * Register the commands accessible from the Console.
     */
    private function registerConsoleCommands()
    {
        $this->commands(MakeTemplateBasedView::class);
    }

}
