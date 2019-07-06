<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class CreateViewSet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:views {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the set of crud views for the new module';

    protected $view_path;

    protected $default_files = [
        'list.blade.php',
        'add.blade.php',
        'edit.blade.php'
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->view_path = base_path('resources/views/');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->view_path   .= $this->argument('name');
        $this->check_set_root_path();
        $this->check_file_exists_else_create();
        $this->info('Views of '.$this->view_path.' created Successfully');
    }

    public function check_set_root_path()
    {
        if(!File::isDirectory($this->view_path))
        {
            File::makeDirectory($this->view_path, $mode = 0775, true, true);
        }
    }

    public function check_file_exists_else_create()
    {
        foreach($this->default_files as $file):
            $file = $this->view_path."/".$file;
            if(File::exists($file))
            {
                continue;
                //$this->info($file);
                //$this->error($file.' already exists');
            }
            else
            {
                File::put($file,'');
            }
        endforeach;
    }
}
