<?php

namespace App\Repositories\Commission;

use App\Repositories\RepositoriesAbstract;
use App\Repositories\User\UserInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CommissionRepository extends RepositoriesAbstract implements CommissionInterface
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function addCommission(array $data)
    {
        $data['is_received'] = 1;
        $data['is_temp'] = 0;
        $data['note'] = json_encode($data['note']);
        Log::channel('commission')->notice('commission:commission:success', $data);
        return $this->model->create($data);
    }

    public function addCommissionTemp(array $data)
    {
        $data['is_received'] = 0;
        $data['is_temp'] = 1;
        $data['note'] = json_encode($data['note']);
        $data['uid'] = null;
        Log::channel('commission')->notice('commission:commission_temp:success', $data);
        return $this->model->create($data);
    }

    public function myCommissions()
    {
        return $this->model->where('uid', auth_client()['id'])->with(['from', 'prize', 'ticket' => function ($query) {
            $query->with('lottery');
        }])->orderBy('id', 'DESC')->paginate(config('constants.pagination.commission'));
    }

    public function listCommissionsApi($id = null)
    {
        $commissons = $this->model->getModel();
        if ($id) {
            $commissons = $commissons->where('uid', $id);
        }

        $commissons = $commissons->with(['ticket', 'from', 'user'])->orderBy('id', 'DESC')->get();

        $commissons = $commissons->filter(function ($value) {
            return $value['is_temp'] !== 1 && $value['user'] !== null;
        })->map(function ($value) {
            $data = [];
            $data['id'] = $value['id'];
            $data['from_sso_id'] = $value['from']['uid'];
            if ($value['is_temp'] === 0) $data['to_sso_id'] = $value['user']['uid'];
            else $data['to_sso_id'] = null;
            $data['currency'] = $value['currency'];
            $data['lottery_id'] = $value['lottery_id'];
            $data['amount'] = numberFormat($value['amount']);
            $data['percent'] = $value['percent'];
            return $data;
        });
        return $commissons;
    }

    public function listCommissionsSsoId($sso_id)
    {
        return $this->listCommissionsApi(app(UserInterface::class)->getIdBySsoId($sso_id))->groupBy('currency')
            ->map(function ($value) use ($sso_id) {
                $collection = collect($value);
                $children = app(UserInterface::class)->getUsersByParentId($sso_id)->map(function ($value) {
                    $sso_id = $value['uid'];
                   return $this->listCommissionsApi(app(UserInterface::class)->getIdBySsoId($sso_id))->groupBy('currency')
                       ->map(function ($value) use ($sso_id) {
                           $collection = collect($value);
                           $data['sso_id'] = $sso_id;
                           $data['total_amount'] = numberFormat($collection->sum('amount'));
                           return $data;
                       });;
                });
                $data['sso_id'] = $sso_id;
                $data['total_amount'] = numberFormat($collection->sum('amount'));
                $data['children'] = $children;
                return $data;
            });
    }
}
