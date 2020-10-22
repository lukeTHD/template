<?php

namespace App\Repositories\Vault;

use App\Repositories\Game\GameInterface;
use App\Repositories\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VaultRepository extends RepositoriesAbstract implements VaultInterface
{

    protected $vaultAcitivityModel;

    public function __construct(Model $model, Model $vaultAcitivityModel)
    {
        parent::__construct($model);
        $this->vaultAcitivityModel = $vaultAcitivityModel;
    }

    public function getVaultsOfGame($game_code = null)
    {
        $return = [];
        $instance = app(GameInterface::class)->getModel()->with(['games_config' => function ($query) {
            $query->where('type', 'before');
        }, 'vaults' => function ($query) {
            $query->with('game_config');
        }]); 
        if ($game_code) $games = $instance->where('code', $game_code)->first();
        else $games = $instance->get();
        
        if ($game_code) {
            $games_config = $games['games_config'];
            $vaults = collect($games['vaults'])->mapWithKeys(function ($value) {
                return [$value['game_config']['code'] => $value];
            })->sortKeysDesc();
            $return = [
                'games_config' => $games_config,
                'vaults' => $vaults,
                'name' => $games->name,
            ];
        } else {
            foreach ($games as $game) {
                $games_config = $game['games_config'];
                $vaults = collect($game['vaults'])->mapWithKeys(function ($value) {
                    return [$value['game_config']['code'] => $value];
                })->sortKeysDesc();
                $return[] = [
                    'games_config' => $games_config,
                    'vaults' => $vaults,
                    'name' => $game->name,
                ];
            }
        }

        return $return;
    }

    public function getVaultActivitiesByGameCode($game_code)
    {
        $data = $this->vaultAcitivityModel->with(['vault' => function ($query) {
            $query->with('game_config');
        }])->where('game_code', $game_code)->get();
        return $data;
    }

    public function addAmountToJackpotCrate($amount, $params, $game_code = '5x36', $game_config_id = 1)
    {
        DB::beginTransaction();
        try {
            $lastAmount = $this->model->select('value')->where(['game_code' => $game_code, 'game_config_id' => $game_config_id])->orderBy('id', 'DESC')->first()->value;
            $crate = $this->model->create([
                'game_code' => $game_code,
                'game_config_id' => $game_config_id,
                'value' => $lastAmount + $amount
            ]);
            $this->vaultAcitivityModel->create([
                'game_code' => $game_code,
                'vault_id' => $crate->id,
                'value' => $amount,
                'type' => config('constants.credit.type.plus'),
                'reason' => 'received_another_platform',
                'note' => json_encode($params)
            ]);
            DB::commit();
            $flag = true;
            Log::channel('crate')->notice('crate:received:notice', $params ? $params : []);
        } catch (\Exception $exception) {
            DB::rollBack();
            $flag = false;
        }
        return $flag;
    }

}
