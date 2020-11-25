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
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 123123,
                'group_id' => 1
            ],
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'a@gmail.com',
                'password' => 123123,
                'group_id' => 2
            ],
            [
                'name' => 'Nguyễn Văn B',
                'email' => 'b@gmail.com',
                'password' => 123123,
                'group_id' => 2
            ]
        ]);
    }
}
