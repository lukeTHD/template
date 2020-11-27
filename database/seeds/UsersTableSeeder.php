<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::insert([
            [
                'username' => 'admin',
                'display_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 123123,
            ],
            [
                'username' => 'nguyen_a',
                'display_name' => 'Nguyễn Văn A',
                'email' => 'a@gmail.com',
                'password' => 123123,
            ],
            [
                'username' => 'nguyen_b',
                'display_name' => 'Nguyễn Văn B',
                'email' => 'b@gmail.com',
                'password' => 123123,
            ]
        ]);
    }
}
