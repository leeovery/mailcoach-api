<?php

namespace Leeovery\MailcoachApi\Http\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateApiClientRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
        ];
    }
}
