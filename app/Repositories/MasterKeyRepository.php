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
     * Check if key is already purchased
     * 
     * @param $key
     */
    public function isPurchased($key){
        return $this->model->where('key', $key)->where('isAvailable', false)->exists();
    }

    /**
     * Check if key has user
     * 
     * @param $key
     */
    public function hasUser($key) {
        $model = $this->model->where('key', $key)->where('isAvailable', 0)->with('user')->first();

        return ($model && $model->user && $model->user->discord_id);
    }
}
