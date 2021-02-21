<?php

namespace App\Rules\MasterKey;

use Illuminate\Contracts\Validation\Rule;

use App\Repositories\Contracts\MasterKeyRepositoryInterface;

class AuthenticateRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = resolve(MasterKeyRepositoryInterface::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->repository->isAuthenticated($value, request()->discord_id);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Unauthenticated";
    }
}
