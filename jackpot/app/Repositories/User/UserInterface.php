<?php

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Model;

interface UserInterface
{

    public function __construct(Model $model, Model $creditModel, Model $gameConfigModel, Model $gameModel, Model $ticketModel);

    public function getStatistic();

    public function login($user, $token);

    public function check_sso_id($sso_id);

    public function get($id);

    public function get_list_affiliator_of_user($arrUser = []);

    public function myCredit($uid, $currency);

    public function topWinners();

    public function createSsoUser($sso_id);

    public function getSsoIdById($id);

    public function getIdBySsoId($sso_id);

    public function getUsersByParentId($sso_id);
}
