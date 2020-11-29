<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\User\ExistRule as UserExistRule;
use App\Rules\MasterKey\{
    ExistRule as MasterKeyExistRule,
    BindRule as MasterKeyBindRule
};
class VerifyRequest extends FormRequest
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
                new UserExistRule
            ],
            'key' => [
                'required',
                new MasterKeyExistRule,
                new MasterKeyBindRule
            ]
        ];
    }
}
