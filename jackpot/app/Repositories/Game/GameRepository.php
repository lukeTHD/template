<?php

namespace App\Repositories\Game;

use App\Lottery;
use App\LotteryRost;
use App\Repositories\RepositoriesAbstract;
use App\Vault;
use App\VaultActivity;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\GameConfig;

class GameRepository extends RepositoriesAbstract implements GameInterface
{

    protected $gameConfigModel;
    protected $sackModel;
    protected $gameSettingCodeModel;
    protected $vaultModel;

    public function __construct(Model $model, Model $gameConfigModel, Model $sackModel, Model $gameSettingCodeModel, Model $vaultModel)
    {
        parent::__construct($model);
        $this->gameConfigModel = $gameConfigModel;
        $this->sackModel = $sackModel;
        $this->gameSettingCodeModel = $gameSettingCodeModel;
        $this->vaultModel = $vaultModel;
    }

    public function getStatistic($from, $to)
    {
        return $this->convert($this->model->where('created_at', '>=', $from)->where('created_at', '<=', $to)->get());
    }

    public function create(array $data)
    {
        DB::beginTransaction();
        try {
            $rewards = $data['rewards'];
            $shares = $data['share'];
//        return $data;
            $data['end_time'] = Carbon::createFromFormat('H:i:s', $data['roll_time'])->subMinutes(5);
            $sacks = null;
            if (isset($data['sacks'])) $sacks = $data['sacks'];
            unset($data['rewards']);
            unset($data['sacks']);
            unset($data['share']);
            $data['created_id'] = auth()->user()->id;
            $game = new $this->model($data);
            $game->save();
//        return $rewards;
            $gameRewards = $this->addGameRewards($game->code, $rewards);
            $this->addShares($game->code, $shares);
            if ($sacks) {
                $this->addSacks($game->id, $sacks);
            }
            $this->addVaults($game->code, $gameRewards);
            DB::commit();
            return $game;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw new $ex;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try {
//            $rewards = $data['rewards'];
            $shares = $data['share'];
            $data['end_time'] = Carbon::createFromFormat('H:i:s', $data['roll_time'])->subMinutes(5);
            $sacks = null;
            if (isset($data['sacks'])) $sacks = $data['sacks'];
            unset($data['rewards']);
            unset($data['sacks']);
            unset($data['share']);
            $data['updated_id'] = auth()->user()->id;
            $game = $this->model->find($id);
            $game->update($data);
//        return $rewards;
            /*if ($rewards) {
                $gameRewards = $this->addGameRewards($game->code, $rewards);
            }*/
            if ($shares) {
                $this->updateShares($game->code, $shares);
            }
            $game->sacks()->forceDelete();
            if ($sacks) {
                $this->addSacks($game->id, $sacks);
            }
            /*$game->vaults()->forceDelete();
            if (isset($gameRewards)) {
                $this->addVaults($game->code, $gameRewards);
            }*/
            DB::commit();
            return $game;
        } catch (\Exception $ex) {
            DB::rollBack();
            throw new $ex;
        }
    }

    public function addGameRewards($game_code, $rewards)
    {
        $data = collect($rewards)->filter(function ($value, $key) {
            return $value['name'] && $value['value_percent'] >= 0;
        })->map(function ($value, $key) use ($game_code) {
            $gameSettingCode = $this->addGameSettingCode($value['number']);
            $value['game_code'] = $game_code;
            $value['title'] = $value['name'];
            $value['code'] = $gameSettingCode->code;
            $value['type'] = config('constants.game_config.type.before');
            $value['percent'] = $value['value_percent'];
            $value['created_at'] = now();
            $value['updated_at'] = now();
            unset($value['value_percent']);
            unset($value['name']);
            unset($value['number']);
            return $value;
        })->toArray();

        $this->gameConfigModel->insert($data);

        return $data;
    }

    public function addGameSettingCode($code)
    {
        return $this->gameSettingCodeModel->firstOrCreate(
            ['code' => $code],
            ['title' => null, 'wallet_address' => null]
        );
    }

    public function addShares($game_code, $shares)
    {
        $data = collect($shares)->filter(function ($value, $key) {
            return !empty($value['value']);
        })->map(function ($value, $key) use ($game_code) {
            $json = ['currency' => u($value['currency'])];
            if ($key === 'company') {
                $json['ssoId'] = $value['ssoId'];
            }
            $data['game_code'] = $game_code;
            $data['type'] = config('constants.game_config.type.after');
            $data['code'] = $key;
            $data['percent'] = $value['value'];
            $data['note'] = json_encode($json);
            $data['created_at'] = now();
            $data['updated_at'] = now();
            return $data;
        })->toArray();

        $this->gameConfigModel->insert($data);

        return $data;
    }

    public function updateShares($game_code, $shares)
    {
        foreach ($shares as $key => $share) {
            if ($key !== 'parent' && $key !== 'parent-2') {
                $json = ['currency' => u($share['currency'])];
                if ($key === 'company') {
                    $json['ssoId'] = $share['ssoId'];
                }
                $this->gameConfigModel->where(['code' => $key, 'game_code' => $game_code])->update([
                    'percent' => $share['value'],
                    'note' => json_encode($json)
                ]);
            }
        }
    }

    public function addSacks($game_id, $sacks)
    {
        $data = collect($sacks)->map(function ($value, $key) use ($game_id) {
            $_value = $value;
            $value = [];
            $value['game_id'] = $game_id;
            $value['value'] = $_value;
            $value['created_at'] = now();
            $value['updated_at'] = now();
            return $value;
        })->toArray();
        $this->sackModel->insert($data);
    }

    private function convert($data)
    {
        $output = [];
        $uid = 0;
        if (auth()->check()) $uid = auth()->user()->id;
        $format = setting('time_format', $uid)->value;
        foreach ($data as $value) {
            $output[] = [
                'name' => $value->name,
                'quantity' => $value->tickets()->count()
            ];
        }

        return collect($output)->values()->toJson();
    }

    public function allGame()
    {
        $rawVault = DB::raw("(select value from vaults where vaults.game_code=games.code
        and game_config_id=1 order by created_at desc limit 1) as value");
        return $this->model->select($rawVault, "games.*")->where("status", 1)->get();
    }

    public function detailGame($game_code)
    {
//        $rawVault = DB::raw("(select value from vaults where vaults.game_code=games.code
//        and game_config_id=1 order by created_at desc limit 1) as value");
        return $this->model->where("status", 1)->where("code", $game_code)->first();
    }

    public function addVaults($game_code, $game_rewards)
    {

//        $this->vaultModel->
        $game_rewards = collect($game_rewards)->map(function ($value) use ($game_code) {
            $data['game_config_id'] = $this->gameConfigModel->getModel()->where(['code' => $value['code'], 'game_code' => $game_code])->first()->id;
            $data['game_code'] = $game_code;
            $data['value'] = 0;
            $data['created_at'] = now();
            return $data;
        })->toArray();

        $this->vaultModel->insert($game_rewards);
    }

    public function winning_numbers($game_code, $time_start, $time_end)
    {
        //get number winner of game in day
        $sql = Lottery::select("numbers", "id")
            ->whereBetween("created_at", [$time_start, $time_end])
            ->where("game_code", $game_code);
        return $sql->first();
    }

    public function winning_numbers_roster($lottery_id, $nowDay)
    {
//        echo $nowDay;die;
//        echo  LotteryRost::select("value", "sort")->where("lottery_id", $lottery_id)->where("appear_time", "<=", $nowDay)->orderBy("sort", "ASC")->toSql();
        return LotteryRost::select("value", "sort")->where("lottery_id", $lottery_id)->where("appear_time", "<=", $nowDay)->orderBy("sort", "ASC")->get();
    }

    /**
     * @param string $game_code
     * @param float $amount
     * @return array
     * 1: get all list pot of game
     */
    public function split_money_buy_ticket(string $game_code, float $amount)
    {


        return [];
    }

    public function config_reward_after_game(string $game_code)
    {
        return GameConfig::where('type', config('constants.game_config.type.after'))
            ->where('game_code', $game_code)->orderBy("percent", "DESC")->get();
    }

    /**
     * @param $game_code
     * @param $prize
     * @return mixed
     *
     */
    public function vault_prize($game_code, $prize)
    {
        $latDay = Carbon::now()->endOfDay();
        $dataConfig = GameConfig::where('code', $prize)
            ->where('game_code', $game_code)->orderBy("percent", "DESC")->first();
        $dataConfig['vault'] = Vault::where("game_code", $game_code)->where("game_config_id", $dataConfig->id)
            ->where("created_at", "<", $latDay)->orderBy("created_at", 'desc')->first();
        return $dataConfig;
    }


    public function update_vault_reward($game_code, $game_config_id, $amount)
    {
        $last_value_vault = Vault::where("game_code", $game_code)->where("game_config_id", $game_config_id)
            ->orderBy("created_at", 'desc')->first();

        $new_vault = new Vault([
            "game_code" => $game_code,
            "game_config_id" => $game_config_id,
            "value" => format_number_money($last_value_vault->value - $amount)
        ]);
        $new_vault->save();

        VaultActivity::insert([
            "vault_id" => $new_vault->id,
            "game_code" => $game_code,
            "type" => config("constants.credit.type.minus"),
            "value" => $amount,
            "reason" => "reward winner game",
            "note" => "",
            "created_at" => now()
        ]);
        return true;

    }
}
