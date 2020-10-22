<?php

namespace App\Repositories\Vault;

interface VaultInterface
{
    public function getVaultsOfGame($game_code = null);

    public function getVaultActivitiesByGameCode($game_code);

    public function addAmountToJackpotCrate($amount, $params);
}
