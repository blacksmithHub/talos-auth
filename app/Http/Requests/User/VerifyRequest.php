<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\User\AuthorizeRule as UserAuthorizeRule;
use App\Rules\MasterKey\PurchasedRule as MasterKeyPurchasedRule;
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
                'numeric',
                new UserAuthorizeRule
            ],
            'key' => [
                'nullable',
                'string',
                new MasterKeyPurchasedRule
            ]
        ];
    }
}
