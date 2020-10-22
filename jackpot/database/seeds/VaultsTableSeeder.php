<?php

use Illuminate\Database\Seeder;

class VaultsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Vault::create([
            'game_code' => '5x36',
            'value' => 0,
            'game_config_id' => 1,
            'created_at' => now()
        ]);

        \App\Vault::create([
            'game_code' => '5x36',
            'value' => 0,
            'game_config_id' => 2,
            'created_at' => now()
        ]);

        \App\Vault::create([
            'game_code' => '5x36',
            'value' => 0,
            'game_config_id' => 3,
            'created_at' => now()
        ]);

        \App\Vault::create([
            'game_code' => '5x36',
            'value' => 0,
            'game_config_id' => 4,
            'created_at' => now()
        ]);
    }
}
