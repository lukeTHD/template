<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Credit;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'can_login_cms' => 1,
            'group_id' => 1,
            'username' => 'admin',
            'password' => bcrypt('123123'),
        ]);

        $user->save();
    }
}
