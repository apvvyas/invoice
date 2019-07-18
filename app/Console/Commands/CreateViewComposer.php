<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class CreateViewComposer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view-composer {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create A view composer file';

    protected $composer;

    protected $root;

    protected $rootNamespace;

    protected $file;

    protected $error_exists = false;

    /**
     * Create a new command instance.
     *
     * @return void
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->root = app_path().'/Composers';
        $this->rootNamespace = 'App\Composers';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->composer   = $this->argument('name');

        if(!$this->error_exists)
            $this->set_root_and_root_name();
        if(!$this->error_exists)
            $this->check_set_root_path();
        if(!$this->error_exists)
            $this->check_file_exists_else_create();
        if(!$this->error_exists)
            $this->set_details();
        if(!$this->error_exists)
            $this->info('Composer '.$this->composer.' created Successfully');
    }

    public function set_root_and_root_name(){
        $repo_parts = explode('\\',$this->composer);
        $this->composer = array_last($repo_parts);
        array_pop($repo_parts);
        $this->rootNamespace .= '\\'.implode('\\',$repo_parts);
        $this->root .= '/'.implode('/',$repo_parts);
        $this->file = $this->root."/".$this->composer.'.php';
    }

    public function check_set_root_path()
    {
        if(!File::isDirectory($this->root))
        {
            File::makeDirectory($this->root, $mode = 0775, true, true);
        }
    }

    public function check_file_exists_else_create()
    {
        if(File::exists($this->file))
        {
            $this->info($this->file);
            $this->error($this->rootNamespace.'\\'.$this->composer.' already exists');
            $this->error_exists = true; 
        }
        else
        {
            File::put($this->file,$this->get_stub());
        }
    }

    public function get_stub()
    {
        return File::get(app_path().'/Console/Stubs/command-composer.stub');
    }

    public function set_details(){
        $content = File::get($this->file);
        $content = str_replace('$CLASS$', $this->composer, $content);
        $content = trim(str_replace('$CLASS_NAMESPACE$', $this->rootNamespace, $content),'/');

        File::put($this->file,$content);
    }
}
