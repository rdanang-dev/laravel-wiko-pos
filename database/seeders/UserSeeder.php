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

        $adminJo = User::create([
            'name' => 'joshua',
            'email' => 'joshua@wiko.test',
            'password' => bcrypt('joshuakeren123')
        ]);

        $adminJo->assignRole('admin');
    }
}
