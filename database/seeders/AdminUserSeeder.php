<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
            $adminRole = Role::create(['name' => 'Administrator']);
            $veterinarioRole=Role::create(['name' => 'Veterinario']);
            $recepcionRole=Role::create(['name' => 'Recepcion']);
            $permission = Permission::create(['name' => 'crearusuarios']);
            $permission1 = Permission::create(['name' => 'crearcitas']);
            $permission2 = Permission::create(['name' => 'vercitas']);
            $permission3 = Permission::create(['name' => 'diagnosticar']);
            $permission4= Permission::create(['name' => 'cobrar']);
            $permission->assignRole($adminRole);
            $permission1->assignRole($recepcionRole);
            $permission2->assignRole($veterinarioRole);
            $permission3->assignRole($veterinarioRole);
            $permission4->assignRole($recepcionRole);

     
            $adminUser = User::factory()->create([
                'email' => 'adminvt@yopmail.com',
                'password' => bcrypt('123456789')
            ]);
            $adminUser->assignRole('Administrator');

            $recepcionUser  = User::factory()->create([
                'email' => 'recepcionvt@yopmail.com',
                'password' => bcrypt('123456789')
            ]);
            $recepcionUser->assignRole('Recepcion');

            $veterinarioUser  = User::factory()->create([
                'email' => 'veterinariovt@yopmail.com',
                'password' => bcrypt('123456789')
            ]);
            $veterinarioUser->assignRole('Veterinario');
        
    }
}
