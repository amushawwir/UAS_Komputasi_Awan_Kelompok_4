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
        $user = [
            [
                'username' => 'Admin',
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('654321'),
                'role' => 'Admin',
            ],
            [
                'username' => 'Usman77',
                'name' => 'Usman',
                'email' => 'usman@mail.com',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
