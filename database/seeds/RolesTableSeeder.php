<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            [
                'name' => 'update-status-ticket',
                'description' => 'Update status ticket',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'update-status-tickets',
                'description' => 'Update status tickets',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'insert-message',
                'description' => 'Reply',
                'created_at' => now('UTC'),
            ],
        ]);
    }
}
