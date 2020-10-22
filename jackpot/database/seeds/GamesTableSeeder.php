<?php

use Illuminate\Database\Seeder;
use App\Repositories\Game\GameInterface;
use App\Game;
use App\GameReward;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $game = new Game([
            'name' => '5x36',
            'avatar' => 'lottery.png',
            'number_pick' => 5,
            'number_max' => 36,
            'code' => '5x36',
            'description' => 'Description 5x35 game',
            'algorithm' => 'random',
            'price' => 1,
            'status' => 1,
            'created_id' => 1,
            'start_time' => '00:00:00',
            'end_time' => '23:45:00',
            'roll_time' => '23:50:00',
            'appear_time' => '23:52:00',
            'ticket_limit' => 999,
            'minimum_ticket' => 3,
            'created_at' => now()
        ]);

        $game->save();

        \App\Sack::create([
            'value' => 4,
            'game_id' => $game->id
        ]);

        \App\Sack::create([
            'value' => 3,
            'game_id' => $game->id
        ]);

        $game_id = $game->id;

        $game_code = $game->code;

        $gameSettingCode = [
            'before' => [
                [
                    'code' => 5,
                    'title' => 'Jackpot',
                    'wallet_address' => null
                ],
                [
                    'code' => 4,
                    'title' => 'Gold Crate',
                    'wallet_address' => null
                ],
                [
                    'code' => 3,
                    'title' => 'Silver Crate',
                    'wallet_address' => null
                ],
                [
                    'code' => 2,
                    'title' => 'Bronze Crate',
                    'wallet_address' => null
                ]
            ],
            'after' => [
                [
                    'code' => 'return',
                    'title' => 'share_return',
                    'wallet_address' => 'return'
                ],
                [
                    'code' => 'company',
                    'title' => 'share_company',
                    'wallet_address' => 'company'
                ],
                [
                    'code' => 'parent',
                    'title' => 'share_parent',
                    'wallet_address' => 'parent'
                ],
                [
                    'code' => 'parent-2',
                    'title' => 'share_parent_2',
                    'wallet_address' => 'parent-2'
                ]
            ]
        ];

        foreach ($gameSettingCode as $type => $gSettingCode) {
            foreach ($gSettingCode as $_gSettingCode) {
                $gameTitle = $_gSettingCode['title'];
                if ($type == 'before') {
                    $_gSettingCode['title'] = null;
                }

                \App\GameSettingCode::create($_gSettingCode);

                $percent = null;

                $note = null;
                if ($type == 'after') {
                    if ($_gSettingCode['code'] == 'return') {
                        $percent = 10;
                    }
                    if ($_gSettingCode['code'] == 'company') {
                        $percent = 5;
                        $note = '{"ssoId":"479719875","currency":"ETI"}';
                    }
                    if ($_gSettingCode['code'] == 'parent') {
                        $percent = 7.5;
                    }
                    if ($_gSettingCode['code'] == 'parent-2') {
                        $percent = 2.5;
                    }
                } else {
                    if ($_gSettingCode['code'] == 5) {
                        $percent = 70;
                    }
                    if ($_gSettingCode['code'] == 4) {
                        $percent = 20;
                    }
                    if ($_gSettingCode['code'] == 3) {
                        $percent = 7;
                    }
                    if ($_gSettingCode['code'] == 2) {
                        $percent = 3;
                    }
                }

                \App\GameConfig::create([
                    'game_code' => $game_code,
                    'type' => $type,
                    'title' => $gameTitle,
                    'code' => $_gSettingCode['code'],
                    'percent' => $percent,
                    'note' => $note
                ]);
            }
        }

//        $games_config = new \App\GameConfig([
//            'game_code' => $game_code,
//            'type' => config('constant.game_config.type.before'),
//            'title' => ''
//        ]);
        /*
                $gameRewards = [
                    [
                        'name' => 'Jackpot',
                        'value_percent' => 70,
                        'game_id' => $game_id,
                        'number' => 5,
                        'share_new' => 10,
                        'share_company' => 5,
                        'share_up' => 7.5,
                        'share_level_2' => 2.5,
                        'created_at' => now()
                    ],
                    [
                        'name' => 'Giải nhất',
                        'value_percent' => 20,
                        'game_id' => $game_id,
                        'number' => 4,
                        'share_new' => 10,
                        'share_company' => 5,
                        'share_up' => 7.5,
                        'share_level_2' => 2.5,
                        'created_at' => now()
                    ],
                    [
                        'name' => 'Giải nhì',
                        'value_percent' => 7,
                        'game_id' => $game_id,
                        'number' => 3,
                        'share_new' => 10,
                        'share_company' => 5,
                        'share_up' => 7.5,
                        'share_level_2' => 2.5,
                        'created_at' => now()
                    ],
                    [
                        'name' => 'Giải ba',
                        'value_percent' => 3,
                        'game_id' => $game_id,
                        'number' => 2,
                        'share_new' => 10,
                        'share_company' => 5,
                        'share_up' => 7.5,
                        'share_level_2' => 2.5,
                        'created_at' => now()
                    ]
                ];

                GameReward::insert($gameRewards);*/
    }
}
