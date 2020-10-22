<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Vault\VaultInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrateController extends Controller
{

    protected $game_config = [
        'jackpot' => 1,
        'gold' => 2,
        'silver' => 3,
        'bronze' => 4
    ];

    protected $game_code = '5x36';

    protected $same = [
        'jackpot' => 5,
        'gold' => 4,
        'silver' => 3,
        'bronze' => 2
    ];

    protected $vaultRepository;

    public function __construct(VaultInterface $vaultRepository)
    {
        $this->vaultRepository = $vaultRepository;
    }

    public function crate(Request $request)
    {
        if($request->prize) {
            $type = $request->prize;
        } else {
            $type = 'all';
        }
        if ($type === 'all') {
            $data = $this->vaultRepository->getVaultsOfGame($this->game_code)['vaults']->map(function ($value) {
                return $this->convertToResponse($value);
            })->values()->toArray();
        } else if (isset($this->same[$type])) {
            $data = $this->convertToResponse($this->vaultRepository->getVaultsOfGame($this->game_code)['vaults'][$this->same[$type]]);
        } else {
            return response()->json(null);
        }

//        dd($data);

        return response()->json($data);
    }

    protected function convertToResponse($value)
    {
        $return['name'] = $value['game_config']['title'];
        $return['amount'] = numberFormat($value['value']);
        return $return;
    }
}
