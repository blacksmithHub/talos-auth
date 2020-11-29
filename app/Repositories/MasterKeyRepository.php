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
     * Check if master key exists.
     * 
     * @param $key
     */
    public function isExists($key) {
        return $this->model->where('key', $key)->where('isAvailable', false)->exists();
    }

    /**
     * Check if user and master key is already bound
     * 
     * @param $key
     */
    public function isBound($key){
        $model = $this->model->where('key', $key)->where('isAvailable', false)->with('user')->first();
        
        return ($model && $model->user && $model->user->status === 'active');
    }
}
