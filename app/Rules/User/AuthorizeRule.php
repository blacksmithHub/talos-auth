<?php

namespace App\Rules\User;

use Illuminate\Contracts\Validation\Rule;

use App\Repositories\Contracts\UserRepositoryInterface;

class AuthorizeRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = resolve(UserRepositoryInterface::class);
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
        return $this->repository->authorize($value, request()->key);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Unauthorized';
    }
}
