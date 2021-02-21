<?php

namespace App\Services;

use Illuminate\Support\Arr;

use App\Repositories\Contracts\{UserRepositoryInterface, MasterKeyRepositoryInterface};
use App\Services\Contracts\CustomerServiceInterface;
use App\Models\MasterKey;

class CustomerService extends Service implements CustomerServiceInterface
{
    /**
     * Create the service instance and inject its repository.
     *
     */
    public function __construct(UserRepositoryInterface $userRepository, MasterKeyRepositoryInterface $masterKeyRepository, MasterKey $masterKey)
    {
        $this->userRepository = $userRepository;
        $this->masterKeyRepository = $masterKeyRepository;
	$this->masterKey = $masterKey;
    }

    /**
     * Bind a specific key.
     * 
     * @param $request
     */
    public function bind($request) 
    {
	$key = $this->masterKey->where('key', Arr::get($request, 'key'))->first();

        $request = Arr::add($request, 'master_key_id', $key->id);

        Arr::pull($request, 'key');

        // TODO: create and return access token

        return $this->userRepository->create($request);
    }

    /**
     * Unbind a specific key.
     * 
     * @param $request
     */
    public function unbind($request) 
    {
        $user = $this->userRepository->me(Arr::get($request, 'discord_id'));

        // TODO: delete access token

        return $this->userRepository->delete($user->id);
    }

    /**
     * Verify a specific key.
     * 
     * @param $request
     */
    public function verify($request) 
    {
        return $this->masterKeyRepository->verify(Arr::get($request, 'key'));
    }

    /**
     * Return customer info.
     * 
     * @param $request
     */
    public function me($request)
    {
        return $this->userRepository->me(Arr::get($request, 'discord_id'));
    }

    /**
     * Login user.
     * 
     * @param $request
     */
    public function login($request)
    {
        // TODO: use access token for login

        $isActive = $this->masterKeyRepository->verify(Arr::get($request, 'key'));
        
        if($isActive) return null;
        
        $data = $this->masterKeyRepository->info(Arr::get($request, 'key'));

        if(!$data) return null;

        return $this->userRepository->update($data->user->id, ['status' => 'active']);
    }

    /**
     * Reset user.
     * 
     * @param $request
     */
    public function reset($request)
    {
        $user = $this->userRepository->me(Arr::get($request, 'discord_id'));

        // TODO: delete access token

        return $this->userRepository->update($user->id, ['status' => 'idle']);
    }
}
