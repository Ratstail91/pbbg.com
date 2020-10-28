<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create "admin" role, used for API requests
        Role::create([
            'name' => 'admin',
            'guard_name' => 'api',
        ]);
    }
}
