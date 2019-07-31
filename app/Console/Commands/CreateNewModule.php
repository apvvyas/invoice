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
    protected $signature = 'set:module {module} {location?} {--ignore=*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Call Basic Steps for Setting a module';

    protected $location;

    protected $module;

    protected $ignore = [];

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
        if($this->option('ignore')){
            $this->ignore = $this->option('ignore');
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
        if(!in_array('controller', $this->ignore)):
            $controller = $this->getLocationPath($this->module,'controller')."Controller";
            $this->call('make:controller',[
                'name' => $controller,
                '--resource' => true
            ]);
        endif;
    }

    protected function createModelMigration(){
        if(!in_array('migration', $this->ignore)):
            $model = "Models\\".$this->getLocationPath($this->module,'model');
            $this->call('make:model',[
                'name' => $model,
                '-m' => true
            ]);
        endif;
    }

    protected function createService(){
        if(!in_array('service', $this->ignore)):
            $service = $this->getLocationPath($this->module,'service')."Service";
            $this->call('make:service',[
                'name' => $service,
            ]);
        endif;
    }

    protected function createRepository(){
        if(!in_array('repository', $this->ignore)):
            $repo = $this->getLocationPath($this->module,'repository')."Repository";
            $this->call('make:repository',[
                'name' => $repo,
            ]);
        endif;
    }

    protected function creatViews(){
        if(!in_array('view', $this->ignore)):
            $view = $this->getLocationPath($this->module)."s";
            $this->call('make:views',[
                'name' => $view,
            ]);
        endif;
    }

    protected function createRequests(){
        if(!in_array('request', $this->ignore)):
            $addRequest = $this->getLocationPath($this->module,'request')."\\AddRequest";
            $updateRequest = $this->getLocationPath($this->module,'request')."\\UpdateRequest";

            $this->call('make:request',[
                'name' => $addRequest,
            ]);
            $this->call('make:request',[
                'name' => $updateRequest,
            ]);
        endif;
    }

    protected function createPermissions(){

        if(!in_array('permission', $this->ignore)):
            $module = strtolower($this->module);
            $permissions = [
                'view_'.$module,
                'add_'.$module,
                'edit_'.$module,
                'delete_'.$module,
            ];
            foreach($permissions as $permission):
                $this->call('permission:create-permission',[
                    'name' => $permission,
                ]);

            endforeach;
        endif;
    }
}
