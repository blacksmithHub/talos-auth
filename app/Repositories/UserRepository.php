<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * Create the repository instance.
     *
     * @param \App\Models\User
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Check if user and key is authorized
     * 
     * @param $id
     * @param $key
     */
    public function authorize($id, $key) {
        $model = $this->model->where('discord_id', $id)->with('masterKey')->first();

        return ($model && $model->masterKey && $model->masterKey->key === $key);
    }

    /**
     * Check if master key exists.
     * 
     * @param $key
     */
    public function isExists($id) {
        return $this->model->where('discord_id', $id)->exists();
    }
}
