<?php

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
        $this->call(SettingsTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(GamesTableSeeder::class);
        $this->call(VaultsTableSeeder::class);
        $this->call(MetaBoxTableSeeder::class);
        $this->call(FAQsTableSeeder::class);
    }
}
