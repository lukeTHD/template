<?php

namespace App\Repositories\GameSettingCode;

use App\Repositories\GameSettingCode\GameSettingCodeInterface;
use App\Repositories\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class GameSettingCodeRepository extends RepositoriesAbstract implements GameSettingCodeInterface
{
    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function getAfter()
    {
        return $this->model->whereNotNull('wallet_address')->get();
    }
}
