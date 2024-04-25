<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::firstOrCreate(['name' => 'student']);
        $role2 = Role::firstOrCreate(['name' => 'teacher']);
        $role3=Role::firstOrCreate(['name' => 'admin']);


    }
}
