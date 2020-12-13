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
     * Check if user and key is authorized
     * 
     * @param $id
     * @param $key
     */
    public function authorize($id, $key) {
        $model = $this->model->where('discord_id', $id)->where('status', 'active')->with('masterKey')->first();

        if($key && $model && $model->masterKey && $model->masterKey->key !== $key) return null;

        return $model;
    }

    /**
     * Check if user is bindable
     * 
     * @param $id
     * @param $key
     */
    public function isBindable($id, $key) {
        $model = $this->model->where('discord_id', $id)->with('masterKey')->first();

        if(!$model && $this->masterKey->hasUser($key)) return false;

        if($model && $model->masterKey && $model->masterKey->key !== $key) return false;

        if($model && $model->status === 'active') return false;

        return true;
    }
}
