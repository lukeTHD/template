<?php

namespace App\Repositories\MetaBox;

use App\Repositories\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Model;

class MetaBoxRepository extends RepositoriesAbstract implements MetaBoxInterface
{


    public function __construct(Model $model)
    {
        parent::__construct($model);
    }

    public function all()
    {
        return $this->model->all();
    }
}
