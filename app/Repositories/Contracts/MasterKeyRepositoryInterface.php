<?php

namespace App\Repositories\Contracts;

interface MasterKeyRepositoryInterface
{
    /**
     * Check if key is in use.
     * 
     * @param $key
     */
    public function isInUse($key);

    /**
     * Check if key and user is authenticated.
     * 
     * @param $key
     * @param $discord_id
     */
    public function isAuthenticated($key, $discord_id);

    /**
     * Verify key
     * 
     * @param $key
     */
    public function verify($key);

    /**
     * Return master key info.
     * 
     * @param $key
     */
    public function info($key);
}
