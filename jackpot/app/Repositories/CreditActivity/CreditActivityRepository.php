<?php
namespace App\Repositories\CreditActivity;

use App\Repositories\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class CreditActivityRepository extends RepositoriesAbstract implements CreditActivityInterface {

    public function getCreditAcitivitesByUserId($uid)
    {
        return $this->model->getModel()->where('uid',$uid)->orderBy('id','DESC')->get();
    }
}
