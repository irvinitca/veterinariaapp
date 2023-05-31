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
    public function addIndexToEmail($email, $index) {
        $parts = explode('@', $email);
        $username = $parts[0];
        $domain = $parts[1];
        $modifiedEmail = $username . $index . '@' . $domain;
        return $modifiedEmail;
    }
    
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'Administrador']);
        $veterinarioRole = Role::create(['name' => 'Veterinario']);
        $recepcionRole = Role::create(['name' => 'Recepcion']);
        $permission = Permission::create(['name' => 'crearusuarios']);
        $permission1 = Permission::create(['name' => 'crearcitas']);
        $permission2 = Permission::create(['name' => 'vercitas']);
        $permission3 = Permission::create(['name' => 'diagnosticar']);
        $permission4 = Permission::create(['name' => 'cobrar']);
        $permission->assignRole($adminRole);
        $permission1->assignRole($recepcionRole);
        $permission2->assignRole($veterinarioRole);
        $permission3->assignRole($veterinarioRole);
        $permission4->assignRole($recepcionRole);

        $adminUser = User::factory()->create([
            'email' => 'adminvt@yopmail.com',
            'password' => bcrypt('123456789')
        ]);
        $adminUser->assignRole('Administrador');

        $recepcionUser = User::factory()->create([
            'email' => 'recepcionvt@yopmail.com',
            'password' => bcrypt('123456789')
        ]);
        $recepcionUser->assignRole('Recepcion');

        $veterinarioUser = User::factory()->create([
            'email' => 'veterinariovt@yopmail.com',
            'password' => bcrypt('123456789')
        ]);
        $veterinarioUser->assignRole('Veterinario');

        for ($i = 1; $i <= 20; $i++) {
            $index = $i;

            $adminUser = User::factory()->create([
                'email' => $this->addIndexToEmail('adminvt@yopmail.com', $index),
                'password' => bcrypt('123456789')
            ]);
            $adminUser->assignRole('Administrador');

            $recepcionUser = User::factory()->create([
                'email' => $this->addIndexToEmail('recepcionvt@yopmail.com', $index),
                'password' => bcrypt('123456789')
            ]);
            $recepcionUser->assignRole('Recepcion');

            $veterinarioUser = User::factory()->create([
                'email' => $this->addIndexToEmail('veterinariovt@yopmail.com', $index),
                'password' => bcrypt('123456789')
            ]);
            $veterinarioUser->assignRole('Veterinario');
        }
    }
}
