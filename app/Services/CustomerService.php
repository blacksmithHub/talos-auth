<?php

namespace App\Services;

use Illuminate\Support\Arr;

use App\Repositories\Contracts\{UserRepositoryInterface, MasterKeyRepositoryInterface};
use App\Services\Contracts\CustomerServiceInterface;
use App\Models\User;

class CustomerService extends Service implements CustomerServiceInterface
{
    /**
     * Create the service instance and inject its repository.
     *
     */
    public function __construct(UserRepositoryInterface $userRepository, User $user, MasterKeyRepositoryInterface $masterKeyRepository)
    {
        $this->userRepository = $userRepository;
        $this->user = $user;
        $this->masterKeyRepository = $masterKeyRepository;
    }

    /**
     * Bind a specific key.
     * 
     * @param $request
     */
    public function bind($request) {
        $request = Arr::add($request, 'master_key_id', 1);

        Arr::pull($request, 'key');

        // TODO: create and return access token

        return $this->userRepository->create($request);
    }

    /**
     * Unbind a specific key.
     * 
     * @param $request
     */
    public function unbind($request) {
        $user = $this->user->where('discord_id', Arr::get($request, 'discord_id'))->first();

        // TODO: delete access token

        return $this->userRepository->delete($user->id);
    }

    /**
     * Verify a specific key.
     * 
     * @param $request
     */
    public function verify($request) {
        return $this->masterKeyRepository->isAuthenticated(Arr::get($request, 'key'), Arr::get($request, 'discord_id'));
    }
}
