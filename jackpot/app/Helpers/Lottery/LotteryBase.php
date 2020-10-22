<?php

namespace App\Helpers\Lottery;

use App\GameConfig;
use App\Repositories\Lottery\LotteryInterface;
use App\Repositories\LotteryRost\LotteryRostInterface;
use App\Repositories\Vault\VaultInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LotteryBase implements LotteryBaseInterface
{

    protected $game;
    protected $number_pick;
    protected $number_max;
    protected $random;
    protected $tickets;
    protected $rewards;
    protected $win_tickets;
    protected $lose_tickets;

    /**
     * Init
     * @param Model $game
     * @return void
     */
    public function init($game)
    {
        $this->game = $game;
        $this->number_pick = $game->number_pick;
        $this->number_max = $game->number_max;
    }

    /**
     * Generate random jackpot numbers
     * @return array
     */
    public function random()
    {
        $number_list = range(1, $this->number_max);
        $numbers = [];
        for ($i = 1; $i <= $this->number_pick; $i++) {
            $number = (string)(array_rand($number_list) + 1);
            if ($number < 10) $number = "0" . "$number";
            $numbers[] = $number;
            unset($number_list[(int)$number - 1]);
        }

        if (setting('jackpot_type')->value == 'manually') $numbers = $this->randomManually();

        $this->random = $numbers;

        // Insert lottery database

        $this->newLottery();

        return $numbers;
    }

    public function randomManually()
    {
        $numbers = [];
        for ($i = 1; $i <= $this->number_pick; $i++) {
            $i = (string)$i;
            if ($i < 10) $i = "0" . $i;
            $numbers[] = $i;
        }
        return $numbers;
    }

    /**
     *
     * Generate new lottery and lottery rost
     */

    public function newLottery()
    {
        DB::beginTransaction();
        try {

            $lastValue = app(VaultInterface::class)->getModel()->select("value")->where([
                "game_code" => $this->game->code,
                'game_config_id' => 1,
            ])->orderBy('id', "desc")->first();

            $price = !empty($lastValue) && !empty($lastValue->value) ? $lastValue->value : 0;

            $lottery = app(LotteryInterface::class)->create([
                'numbers' => json_encode($this->random),
                'game_code' => $this->game->code,
                'total_jackpot' => $price,
                'created_at' => now()
            ]);

            Log::channel('lottery')->notice('lottery:new:notice', [
                'numbers' => $this->random,
                'game_code' => $this->game->code,
            ]);

            app(LotteryRostInterface::class)->rost($lottery->id, $this->game, $this->random);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new $exception;
        }

    }

    /**
     * Format games config to rewards
     * @param Collection $games_config
     * @return Collection
     */
    public function convertRewards($games_config)
    {
        $games_config = $games_config->filter(function ($value) {
            return $value['type'] === 'before';
        });
        return $games_config->mapWithKeys(function ($value, $key) {
            return [$value['code'] => $value['id']];
        });
    }

    /**
     * Add all win tickets to $win_tickets
     * @param array $numbers
     * @return void
     */
    public function findTickets(array $numbers)
    {
        $this->tickets->map(function ($value) use ($numbers) {
            $diff = $this->compare($value['picked'], $numbers);
            if (isset($this->rewards[$diff])) {
                $this->win_tickets[$diff]['users'][] = (string)$value->user->uid;
                $this->win_tickets[$diff]['ticket_ids'][] = $value->id;
                $this->win_tickets[$diff]['tickets'][] = $value;
                $this->win_tickets[$diff]['prize_id'] = $this->rewards[$diff];
            } else {
                $this->lose_tickets[] = $value->id;
            }
        });
    }

    /**
     * Compare random numbers with ticket numbers
     * @param array $numbers
     * @param array $compareNumbers
     * @return int
     */
    public function compare(array $numbers, array $compareNumbers)
    {
        $diff = array_diff($this->convertInt($numbers), $this->convertInt($compareNumbers));
        return $this->number_pick - count($diff);
    }

    /**
     * Convert number of numbers to int
     * @param array $numbers
     * @return array
     */
    public function convertInt(array $numbers)
    {
        return collect($numbers)->map(function ($number) {
            return (int)$number;
        })->toArray();
    }

    /**
     * Load tickets and rewards for get win tickets function
     * @return void
     */
    public function load()
    {
        $this->tickets = $this->game->tickets;
        $this->rewards = $this->convertRewards($this->game->games_config);
    }

}
