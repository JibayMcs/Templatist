<?php

namespace Templatist\Console\Commands;

use Illuminate\Console\Command;

class MakeTemplateBasedView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {name} from {template}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a custom blade view based on a template';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $viewName = strtolower($this->argument('name'));
        $template = $this->argument('template');

        $viewsDir = resource_path() . '/views';
        $templatePath = resource_path() . '/views/template';

        $selectedTemplate = "$templatePath/$template.blade.php";

        if ($viewName === '' || is_null($viewName) || empty($viewName)) {
            return $this->error('Custom view name invalid !');
        }

        if (!$template) {
            if (!file_exists($selectedTemplate)) {
                return $this->error('Template not found !');
            }
            return $this->error('Template name invalid !');
        }

        if ($this->confirm("Do you wish to create \"$viewName\" view based on \"$template\" template ?")) {
            $file = "$viewName.blade.php";

            $file = "$viewsDir/$file";

            if (file_exists($selectedTemplate)) {
                if (!file_exists($file)) {
                    if (copy($selectedTemplate, $file)) {
                        return $this->info("$viewName.blade.php generated!");
                    } else {
                        return $this->error("Unable to create $viewName based on $template !");
                    }
                } else {
                    if ($this->confirm("View $file already exist. Do you want to overwrite it ?")) {
                        if (copy($selectedTemplate, $file)) {
                            return $this->info("$viewName.blade.php generated!");
                        }
                    }
                }
            } else {
                return $this->error("File $selectedTemplate doesn't exist !");
            }
        }
    }
}
