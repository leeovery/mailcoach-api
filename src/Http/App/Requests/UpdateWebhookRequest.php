<?php

namespace Leeovery\MailcoachApi\Http\App\Requests;

use Illuminate\Validation\Rules\In;
use Illuminate\Foundation\Http\FormRequest;
use Leeovery\MailcoachApi\Support\Triggers;

class UpdateWebhookRequest extends FormRequest
{
    public function rules(Triggers $triggers)
    {
        return [
            'name'       => 'required|string',
            'url'        => 'required|url',
            'triggers'   => 'required|array',
            'triggers.*' => ['string', new In($triggers->events()->all())],
        ];
    }

    public function validationData()
    {
        return $this->merge([
            'triggers' => array_keys($this->input('triggers', [])),
        ])->all();
    }

    public function messages()
    {
        return [
            'triggers.required' => 'You must select at least one trigger',
        ];
    }


}