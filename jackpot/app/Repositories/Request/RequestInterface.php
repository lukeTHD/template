<?php

namespace App\Repositories\Request;

interface RequestInterface
{
    public function updateStatus($id, $status, array $data_credit);
}
