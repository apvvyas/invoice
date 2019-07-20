<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CurrencyTablesSeeder::class);
        $this->call(RolePermission::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TaxSeeder::class);
    }
}
