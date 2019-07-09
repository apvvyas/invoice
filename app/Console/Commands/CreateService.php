<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class CreateService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create A service file';

    protected $service;

    protected $root;

    protected $rootNamespace;

    protected $file;

    protected $error_exists = false;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->root = app_path().'/Services';
        $this->rootNamespace = 'App\Services';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->service   = $this->argument('name');

        if(!$this->error_exists)
            $this->set_root_and_root_name();
        if(!$this->error_exists)
            $this->check_set_root_path();
        if(!$this->error_exists)
            $this->check_file_exists_else_create();
        if(!$this->error_exists)
            $this->set_details();
        if(!$this->error_exists)
            $this->info('service '.$this->service.' created Successfully');
    }

    public function set_root_and_root_name(){
        $repo_parts = explode('\\',$this->service);
        $this->service = array_last($repo_parts);
        array_pop($repo_parts);
        $this->rootNamespace .= '\\'.implode('\\',$repo_parts);
        $this->root .= '/'.implode('/',$repo_parts);
        $this->file = $this->root."/".$this->service.'.php';
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
            $this->error($this->rootNamespace.'\\'.$this->service.' already exists');
            $this->error_exists = true; 
        }
        else
        {
            File::put($this->file,$this->get_stub());
        }
    }

    public function get_stub()
    {
        return File::get(app_path().'/Console/Stubs/command-service.stub');
    }

    public function set_details(){
        $content = File::get($this->file);
        $content = str_replace('$CLASS$', $this->service, $content);
        $content = str_replace('$CLASS_NAMESPACE$', $this->rootNamespace, $content);

        File::put($this->file,$content);
    }
}
