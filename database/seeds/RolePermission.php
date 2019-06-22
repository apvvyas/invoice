<?php

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = Role::create([
            'owner_id'=>'1',
            'name'=>'1_super_admin',
            'title'=>'Super Admin',
            'guard_name'=>'web'
        ]);
        $super_admin->givePermissionTo(Permission::all());
    }
}
