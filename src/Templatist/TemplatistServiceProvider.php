<?php

namespace Templatist;

use Illuminate\Support\ServiceProvider;
use Templatist\Console\Commands\MakeTemplateBasedView;


class TemplatistServiceProvider extends ServiceProvider
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
