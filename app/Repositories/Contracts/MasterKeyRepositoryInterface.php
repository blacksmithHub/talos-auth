<?php

namespace App\Repositories\Contracts;

interface MasterKeyRepositoryInterface
{
    /**
     * Check if master key exists.
     * 
     * @param $key
     */
    public function isExists($key);

    /**
     * Check if user and master is already bound
     * 
     * @param $key
     */
    public function isBound($key);
}
