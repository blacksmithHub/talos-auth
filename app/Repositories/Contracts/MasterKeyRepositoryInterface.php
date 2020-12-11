<?php

namespace App\Repositories\Contracts;

interface MasterKeyRepositoryInterface
{
    /**
     * Check if key is purchased
     * 
     * @param $key
     */
    public function isPurchased($key);

    /**
     * Check if key has user
     * 
     * @param $key
     */
    public function hasUser($key);
}
