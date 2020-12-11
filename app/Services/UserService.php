<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Models\User;

class UserService extends Service implements UserServiceInterface
{
    /**
     * Create the service instance and inject its repository.
     *
     * @param App\Repositories\Contracts\UserRepositoryInterface
     */
    public function __construct(UserRepositoryInterface $repository, User $model)
    {
        $this->model = $model;
        $this->repository = $repository;
    }

    /**
     * Bind a specific key
     *
     * @param array $request
     */
    public function bind(array $request){
        DB::beginTransaction();

        try {
            $model = $this->model->where('discord_id', Arr::get($request, 'discord_id'))->where('status', 'idle')->first();

            $data = [
                'username' => Arr::get($request, 'username'),
                'discriminator' => Arr::get($request, 'discriminator'),
                'status' => 'active'
            ];

            $response = $this->repository->update($model->id, $data);

            DB::commit();

            return $response;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Unbind a specific key
     *
     * @param array $request
     */
    public function unbind(array $request){
        DB::beginTransaction();

        try {
            $model = $this->model->where('discord_id', Arr::get($request, 'discord_id'))->where('status', 'active')->first();

            $response = $this->repository->update($model->id, ['status' => 'idle']);

            return $response;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Verify a user key
     *
     * @param array $request
     */
    public function verify(array $request){
        return $this->repository->authorize(Arr::get($request, 'discord_id'), Arr::get($request, 'key'));
    }
}
