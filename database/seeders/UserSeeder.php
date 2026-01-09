<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@ehb.be',
            'password' => Hash::make('Password!321'),
            'role' => 'admin',
            'birthday' => '1990-01-01',
            'about_me' => 'Ik ben de beheerder van deze telefoon webshop.',
        ]);

        // Regular users
        User::create([
            'name' => 'Jan Janssen',
            'username' => 'janjanssen',
            'email' => 'jan@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'birthday' => '1995-05-15',
            'about_me' => 'Telefoon liefhebber en tech enthusiast.',
        ]);

        User::create([
            'name' => 'Marie Dupont',
            'username' => 'mariedupont',
            'email' => 'marie@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'birthday' => '1992-08-22',
            'about_me' => 'Passie voor de nieuwste smartphones en technologie.',
        ]);

        User::create([
            'name' => 'Pieter Van der Berg',
            'username' => 'pieter',
            'email' => 'pieter@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'birthday' => '1988-12-10',
            'about_me' => 'Gamer en telefoon expert.',
        ]);
    }
}
