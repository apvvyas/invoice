<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Modules\OwnerSetup\Entities\Owner;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SuperAdmin = User::create(
        [
            'name' => 'Super Admin',
            'first_name'=>'Super',
            'last_name'=>'Admin',
            'email' => 'superadmin@kento.com',
            'email_verified_at' => now(),
            'phone'=>'0000000000',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $SuperAdmin->assignRole('Super Admin');
      
    }
}
