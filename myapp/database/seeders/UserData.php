<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserData extends Seeder
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
                'name' => 'Administrator',
                'email' => 'admin@abel.com',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'role' => 'admin',
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@abel.com',
                'username' => 'kasir',
                'password' => bcrypt('123456'),
                'role' => 'kasir',
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@abel.com',
                'username' => 'manager',
                'password' => bcrypt('123456'),
                'role' => 'manager',
            ],
        ];

        foreach($user as $key => $value){
            User::create($value);
        }

    }
}
