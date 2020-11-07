<?php

namespace App\Services;

use Illuminate\Support\Arr;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Models\{User, MasterKey};

class UserService extends Service implements UserServiceInterface
{
    /**
     * Create the service instance and inject its repository.
     *
     * @param App\Repositories\Contracts\UserRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $repository, MasterKey $masterKey, User $model)
    {
        $this->model = $model;
        $this->repository = $repository;
        $this->masterKey = $masterKey;
    }

    /**
     * Bind a specific key
     *
     * @param array $request
     */
    public function bind(array $request){
        $masterKey = $this->masterKey->where('key', Arr::get($request, 'key'))->where('isAvailable', false)->with('user')->first();
        $model = $this->model->where('master_key_id', $masterKey->id)->first();

        return $this->repository->update($model->id, ['discord_id' => Arr::get($request, 'discord_id'), 'status' => 'active']);
    }

    /**
     * Unbind a specific key
     *
     * @param array $request
     */
    public function unbind(array $request){
        $model = $this->model->where('discord_id', Arr::get($request, 'discord_id'))->first();

        return $this->repository->update($model->id, ['discord_id' => null, 'status' => 'idle']);
    }
}
