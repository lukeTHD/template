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
        //
        $data = [
            [
                'name' => 'contact-index',
                'description' => 'Show all contacts',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'contact-edit',
                'description' => 'Detail contact',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'dashboard-index',
                'description' => 'Dashboard index',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'faq-index',
                'description' => 'Show all faqs',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'faq-store',
                'description' => 'Save faqs',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'game-index',
                'description' => 'Show all games',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'game-create',
                'description' => 'Show form create a game',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'game-store',
                'description' => 'Store a game',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'game-edit',
                'description' => 'Show form edit a game',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'game-update',
                'description' => 'Update a game',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'group-index',
                'description' => 'Show all groups',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'group-create',
                'description' => 'Show form create a group',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'group-store',
                'description' => 'Store a group',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'group-edit',
                'description' => 'Show form edit a group',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'group-update',
                'description' => 'Update a group',
                'created_at' => now('UTC'),
            ],
            [
                'name' => 'lottery-index',
                'description' => 'Show all lotteries',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'lottery-edit',
                'description' => 'Detail a lottery',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'mail-index',
                'description' => 'Show mail reward',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'mail-update',
                'description' => 'Update mail reward',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'metabox-index',
                'description' => 'Show all metabox',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'metabox-store',
                'description' => 'Save metabox',
                'created_at' => now('UTC')
            ],
            //['index','edit','updateStatus']
            [
                'name' => 'request-index',
                'description' => 'Show all requests withdraw',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'request-edit',
                'description' => 'Detail a request withdraw',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'request-updateStatus',
                'description' => 'Update status of the request withdraw',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'setting-index',
                'description' => 'Show all settings',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'setting-update',
                'description' => 'Update setting',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'ticket-index',
                'description' => 'Show all tickets',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'ticket-edit',
                'description' => 'Detail ticket',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'user-index',
                'description' => 'Show all users',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'user-create',
                'description' => 'Show form create a user',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'user-store',
                'description' => 'Store a user',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'user-edit',
                'description' => 'Show formm edit a user',
                'created_at' => now('UTC')
            ],
            [
                'name' => 'user-update',
                'description' => 'Update a user',
                'created_at' => now('UTC')
            ]
        ];
        Role::insert($data);
    }
}
