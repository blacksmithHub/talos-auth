<?php

namespace App\Repositories\Contracts;

use App\Repositories\Support\{
    UpdateInterface as Update
};

interface UserRepositoryInterface extends Update
{
    /**
     * Check if user and key is authorized
     * 
     * @param $id
     * @param $key
     */
    public function authorize($id, $key);
}
