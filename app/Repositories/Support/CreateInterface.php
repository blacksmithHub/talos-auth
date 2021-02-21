<?php

namespace App\Repositories\Support;

interface CreateInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param array $request
     * @return mixed
     */
    public function create(array $request);
}
