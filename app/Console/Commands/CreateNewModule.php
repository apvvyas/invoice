<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateNewModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:module {module} {location?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call Basic Steps for Setting a module';

    protected $location;

    protected $module;

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
     * @return mixed
     */
    public function handle()
    {
        //Set the Module and location
        $this->module = $this->argument('module');
        if($this->argument('location')){
            $this->location = $this->argument('location');
        }

        //Create Options
        $this->createController();
        $this->createService();
        $this->createRepository();
        $this->createModelMigration();
        $this->creatViews();
        $this->createRequests();
    }

    public function getLocationPath($option , $from = 'view'){
        if(in_array($from,['controller'])){
            $append = ucfirst($this->location)."\\";
            return $append.$option;
        }
        elseif(in_array($from,['view'])){
            $append = $this->location.'/';
            $option = strtolower($option);
            return $append.$option;
        }
        return $option;
    }

    protected function createController(){
        $controller = $this->getLocationPath($this->module,'controller')."Controller";
        $this->call('make:controller',[
            'name' => $controller,
            '--resource' => true
        ]);
    }

    protected function createModelMigration(){
        $model = "Models\\".$this->getLocationPath($this->module,'model');
        $this->call('make:model',[
            'name' => $model,
            '-m' => true
        ]);
    }

    protected function createService(){
        $service = $this->getLocationPath($this->module,'service')."Service";
        $this->call('make:service',[
            'name' => $service,
        ]);
    }

    protected function createRepository(){
        $repo = $this->getLocationPath($this->module,'repository')."Repository";
        $this->call('make:repository',[
            'name' => $repo,
        ]);
    }

    protected function creatViews(){
        $view = $this->getLocationPath($this->module)."s";
        $this->call('make:views',[
            'name' => $view,
        ]);
    }

    protected function createRequests(){
        $addRequest = $this->getLocationPath($this->module,'request')."\\AddRequest";
        $updateRequest = $this->getLocationPath($this->module,'request')."\\UpdateRequest";

        $this->call('make:request',[
            'name' => $addRequest,
        ]);
        $this->call('make:request',[
            'name' => $updateRequest,
        ]);
    }
}
