<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\MasterKeyRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * Create the repository instance.
     *
     * @param \App\Models\User
     */
    public function __construct(User $model, MasterKeyRepositoryInterface $masterKey)
    {
        $this->model = $model;
        $this->masterKey = $masterKey;
    }

    /**
     * Check if user exist.
     * 
     * @param $discordId
     */
    public function isExist($discordId) 
    {
        return $this->model->where('discord_id', $discordId)->first();
    }
}
