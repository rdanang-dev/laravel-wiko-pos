<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Hilman',
            'email' => 'Hilman@wiko.test',
            'password' => bcrypt('kmzway87aa')
        ]);

        $admin->assignRole('admin');
    }
}