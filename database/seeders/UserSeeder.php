<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superAdmin = User::create([
            'name'           => 'Super Admin',
            'email'          => 'superadmin@web.com',
            'password'       => Hash::make('super1234'),
        ]);
        $superAdmin->assignRole('super-admin');

        $admin = User::create([
            'name'           => 'Admin',
            'email'          => 'admin@web.com',
            'password'       => Hash::make('admin1234'),
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name'           => 'Udin',
            'email'          => 'udin@web.com',
            'password'       => Hash::make('user1234'),
        ]);
        $user->assignRole('user');
    }
}
