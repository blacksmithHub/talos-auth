<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\MasterKey\InUseRule as MasterKeyInUseRule;
use App\Rules\User\ExistRule as UserExistRule;

class BindRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'discord_id' => [
                'required',
                'numeric',
                new UserExistRule
            ],
            'username' => [
                'required',
                'string'
            ],
            'discriminator' => [
                'required',
                'string'
            ],
            'key' => [
                'required',
                'string',
                new MasterKeyInUseRule
            ]
        ];
    }
}
