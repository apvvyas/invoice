<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RevokeRolePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:revoke-role-permission {role} {permission*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign permission to role';

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
        $role = Role::where('name',$this->argument('role'))->first();

        $permissions = $this->argument('permission');

        foreach($permissions as $permission)
            $role->revokePermissionTo($permission);
    }
}