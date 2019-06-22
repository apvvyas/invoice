<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;

class CreateRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create A repository file';

    protected $repository;

    protected $root;

    protected $rootNamespace;

    protected $file;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->root = app_path().'/Repositories';
        $this->rootNamespace = 'App\Repositories';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->repository   = $this->argument('repo');
        $this->set_root_and_root_name();
        $this->check_set_root_path();
        $this->check_file_exists_else_create();
        $this->set_details();
        $this->info('Repository '.$this->repository.' created Successfully');
    }

    public function set_root_and_root_name(){

        $repo_parts = explode('\\',$this->repository);
        $this->repository = array_last($repo_parts);
        array_pop($repo_parts);
        $this->rootNamespace .= "\\".implode('\\',$repo_parts);
        $this->root .= '/'.implode('/',$repo_parts);
        $this->file = $this->root."/".$this->repository.'.php';
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
            $this->error($this->rootNamespace.'\\'.$this->repository.' already exists');
            exit;
        }
        else
        {
            File::put($this->file,$this->get_stub());
        }
    }

    public function get_stub()
    {
        return File::get(app_path().'/Console/Stubs/command-repository.stub');
    }

    public function set_details(){
        $content = File::get($this->file);
        $content = str_replace('$CLASS$', $this->repository, $content);
        $content = str_replace('$CLASS_NAMESPACE$', $this->rootNamespace, $content);

        File::put($this->file,$content);
    }
}
