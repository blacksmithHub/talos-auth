<?php

namespace App\Repositories\Contracts;

use App\Repositories\Support\{
    UpdateInterface as Update
};

interface UserRepositoryInterface extends Update
{
    /**
     * Check if user exist.
     * 
     * @param $discordId
     */
    public function isExist($discordId);
}
