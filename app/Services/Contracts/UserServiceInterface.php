<?php

namespace App\Services\Contracts;

interface UserServiceInterface
{
    /**
     * Bind a specific key
     *
     * @param array $request
     * @return mixed
     */
    public function bind(array $request);

    /**
     * Unbind a specific key
     *
     * @param array $request
     * @return mixed
     */
    public function unbind(array $request);
}
