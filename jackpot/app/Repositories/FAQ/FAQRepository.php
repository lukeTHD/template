<?php

namespace App\Repositories\FAQ;

use App\Repositories\RepositoriesAbstract;

class FAQRepository extends RepositoriesAbstract implements FAQInterface
{
    public function listFAQ()
    {
        return $this->model->all();
    }
}
