<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Ibrahim Bader',
                'email' => 'ibrahimbader@gmail.com',
                'password' => 'ibrahim123',
            ],
            [
                'name' => 'Anas Alshanti',
                'email' => 'anasalshanti@gmail.com',
                'password' => 'anas123',
            ],
            [
                'name' => 'Abdallah Alzaeem',
                'email' => 'abdallahalzaeem@gmail.com',
                'password' => 'abdallaha123',
            ],
            [
                'name' => 'Ayah Hisham',
                'email' => 'ayahhisham@gmail.com',
                'password' => 'ayah123',
            ],
            [
                'name' => 'Sara Khalil',
                'email' => 'sarakhalil@gmail.com',
                'password' => 'sara123',
            ],
        ];

        foreach ($admins as $admin) {
            User::firstOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                ]
            );
        }
    }
}
