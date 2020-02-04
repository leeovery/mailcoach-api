<?php

namespace Leeovery\MailcoachApi\Http\Requests;

use Illuminate\Validation\Validator;

class UpdateContactRequest extends ContactRequest
{
    public function rules()
    {
        return [
            'email'           => 'sometimes|email:rfc,dns',
            'list_ids'        => 'sometimes|array',
            'list_ids.*'      => 'sometimes|integer|exists:mailcoach_email_lists,id',
            'attributes'      => 'sometimes|nullable|array',
            'attributes.*'    => 'sometimes|nullable|string',
            'unsubscribe_all' => 'sometimes|accepted|must_be_different:resubscribe_all',
            'resubscribe_all' => 'sometimes|accepted|must_be_different:unsubscribe_all',
        ];
    }

    protected function withValidator(Validator $validator)
    {
        $validator->addExtension('must_be_different', function ($attribute, $value, $parameters, $validator) {
            return ! ($value === $this->input($parameters[0]));
        });

        $validator->addReplacer('must_be_different', function ($message, $attribute, $rule, $parameters, $validator) {
            return "The {$attribute} value must be different from {$parameters[0]}";
        });
    }
}
