<?php

namespace App\Repositories\Commission;

interface CommissionInterface
{
    public function addCommission(array $data);

    public function addCommissionTemp(array $data);

    public function myCommissions();

    public function listCommissionsApi($id = null);

    public function listCommissionsSsoId($sso_id);
}
