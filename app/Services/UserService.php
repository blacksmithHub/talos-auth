<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Models\{User, MasterKey};

class UserService extends Service implements UserServiceInterface
{
    /**
     * Create the service instance and inject its repository.
     *
     * @param App\Repositories\Contracts\UserRepositoryInterface
     * @param App\Models\User $model
     * @param App\Models\User $model
     */
    public function __construct(UserRepositoryInterface $repository, 
        User $model,
        MasterKey $masterKey)
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
        DB::beginTransaction();

        try {
            $masterKey = $this->masterKey->where('key', Arr::get($request, 'key'))->where('isAvailable', false)->first();
            
            $data = [
                'discord_id' => Arr::get($request, 'discord_id'),
                'username' => Arr::get($request, 'username'),
                'discriminator' => Arr::get($request, 'discriminator'),
                'status' => 'active'
            ];

            $response = $this->model->updateOrCreate(
                [
                    'master_key_id' => $masterKey->id,
                    'status' => 'idle'
                ], 
                $data
            );

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
            $masterKey = $this->masterKey->where('key', Arr::get($request, 'key'))->where('isAvailable', false)->first();

            $model = $this->model->where('discord_id', Arr::get($request, 'discord_id'))->where('status', 'active')->where('master_key_id', $masterKey->id)->first();

            $response = $this->repository->update($model->id, ['status' => 'idle']);

            DB::commit();
            
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
