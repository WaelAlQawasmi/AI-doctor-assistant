<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@infinta-jo.com',
            'password' => bcrypt('infinta2023'),
            'phone'=>'0788809906',
            ]);
    
    
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'doctor']);
        $TA = Role::create(['name' => 'TechnicalAssistant']);
        $TA->syncPermissions(['manage users', 'delete users','create doctor user']);
        $adminRole->syncPermissions(Permission::all());

        $user->assignRole([$adminRole->id]);

    }
}
