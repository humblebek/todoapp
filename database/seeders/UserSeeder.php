<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Alice Johnson',
            'email' => 'alice@example.com',
            'password' => Hash::make('alice123'),
        ]);

        User::create([
            'name' => 'Bob Smith',
            'email' => 'bob@example.com',
            'password' => Hash::make('bobbb123'),
        ]);

        User::create([
            'name' => 'Charlie Brown',
            'email' => 'charlie@example.com',
            'password' => Hash::make('charlie123'),
        ]);
    }
}
