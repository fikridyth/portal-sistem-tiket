<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collections = [
            [ 'name' => 'Fikri', 'email' => 'fikri@gmail.com', 'password' => bcrypt('fikri'), 'role' => 'admin_ticket' ],
            [ 'name' => 'Hidayat', 'email' => 'hidayat@gmail.com', 'password' => bcrypt('hidayat'), 'role' => 'admin_transaction' ],
        ];

        collect($collections)->each(function ($data) {
            User::create($data);
        });
    }
}
