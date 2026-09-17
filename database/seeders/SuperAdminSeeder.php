<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'superadmin@sembark.com'
            ],
            [
                'name' => 'Praveeen',
                'password' => Hash::make('123456'),
                'role' => 'SuperAdmin',
                'company_id' => null,
            ]
        );
    }
}
