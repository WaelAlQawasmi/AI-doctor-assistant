<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'create doctor user']);
        Permission::create(['name' => 'unlimit points']);
        Permission::create(['name' => 'add points']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'sensitive data']);
    }
}
