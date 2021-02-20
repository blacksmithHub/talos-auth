<?php

namespace App\Services\Contracts;

interface CustomerServiceInterface
{
    /**
     * Bind a specific key.
     * 
     * @param $request
     */
    public function bind($request);

    /**
     * Unbind a specific key.
     * 
     * @param $request
     */
    public function unbind($request);

    /**
     * Verify a specific key.
     * 
     * @param $request
     */
    public function verify($request);

    /**
     * Return customer info.
     * 
     * @param $request
     */
    public function me($request);
}
