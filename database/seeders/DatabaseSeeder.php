<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'status' => 'admin',
            'password' => bcrypt('0123456789')
        ]);
    }
}