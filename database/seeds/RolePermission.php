<?php

use Artisan;
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
        $role = Role::create([
            'name'=>'Super Admin',
            'guard_name'=>'web'
        ]);
        $permissions = [
            'view_user','add_user','edit_user','delete_user',
            'view_tax','add_tax','edit_tax','delete_tax',
            'view_product','view_invoice','view_recipient',
        ];
        
        foreach($permissions as $permission)
            $role->givePermissionTo($permission);

        $role = Role::create([
            'name'=>'Admin',
            'guard_name'=>'web'
        ]);
        $permissions = [
            'add_product','edit_product','delete_product',
            'add_invoice','delete_invoice','export_invoice',
            'add_recipient','edit_recipient','delete_recipient',
            'view_product','view_invoice','view_recipient',
        ];
        foreach($permissions as $permission)
            $role->givePermissionTo($permission);
        
    }
}
