<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\RoleManagement;
use App\Models\User;

class RoleManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleManagement::factory()->create([
            'name_module' => 'admin',
            'product' => 'view,create,delete',
        ]);

        RoleManagement::factory()->create([
            'name_module' => 'member',
            'product' => 'view',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'role_id' => '1'
        ]);

    }
}
 