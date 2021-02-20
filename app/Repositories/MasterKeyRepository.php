<?php

namespace App\Repositories;

use App\Models\MasterKey;
use App\Repositories\Contracts\MasterKeyRepositoryInterface;

class MasterKeyRepository extends Repository implements MasterKeyRepositoryInterface
{
    /**
     * Create the repository instance.
     *
     * @param \App\Models\MasterKey
     */
    public function __construct(MasterKey $model)
    {
        $this->model = $model;
    }

    /**
     * Check if key is in use.
     * 
     * @param $key
     */
    public function isInUse($key)
    {
        return $this->model->where('key', $key)->where('isAvailable', false)->has('user')->first();
    }

    /**
     * Check if key and user is authenticated.
     * 
     * @param $key
     * @param $discord_id
     */
    public function isAuthenticated($key, $discord_id)
    {
        $model = $this->model->where('key', $key)->where('isAvailable', false);

        if(!$model->has('user')->first()) return null;

        $model = $model->with('user')->first();

        return ($model->user->discord_id === $discord_id);
    }

    /**
     * Verify key
     * 
     * @param $key
     */
    public function verify($key)
    {
        $model = $this->model->where('key', $key)->where('isAvailable', false);

        if(!$model->has('user')->first()) return null;

        $model = $model->with('user')->first();

        if($model->user->status === 'idle') return null;

        return $model;
    }

    /**
     * Return master key info.
     * 
     * @param $key
     */
    public function info($key)
    {
        $model = $this->model->where('key', $key)->where('isAvailable', false);

        if(!$model->has('user')->first()) return null;

        return $model->with('user')->first();
    }
}
