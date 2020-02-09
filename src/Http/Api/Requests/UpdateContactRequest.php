<?php

namespace Leeovery\MailcoachApi\Http\Api\Requests;

use Illuminate\Support\Collection;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Foundation\Http\FormRequest;
use Leeovery\MailcoachApi\Models\EmailList;

class UpdateContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email'                       => 'sometimes|email:rfc,dns',
            'unsubscribe_from_list_ids'   => 'sometimes|array',
            'unsubscribe_from_list_ids.*' => ['sometimes', 'integer', new Exists(EmailList::class, 'id')],
            'resubscribe_to_list_ids'     => 'sometimes|array',
            'resubscribe_to_list_ids.*'   => ['sometimes', 'integer', new Exists(EmailList::class, 'id')],
            'attributes'                  => 'sometimes|nullable|array',
            'attributes.*'                => 'sometimes|nullable|string',
            'unsubscribe_all'             => 'sometimes|accepted|must_be_different:resubscribe_all',
            'resubscribe_all'             => 'sometimes|accepted|must_be_different:unsubscribe_all',
        ];
    }

    public function attributes()
    {
        return [
            'unsubscribe_from_list_ids.*' => 'list ID for unsubscribing',
            'resubscribe_to_list_ids.*'   => 'list ID for resubscribing',
        ];
    }

    public function getEmailListsForUnsubscribe(): Collection
    {
        return collect($this->input('unsubscribe_from_list_ids', []))
            ->map(fn($listId) => EmailList::find($listId));
    }

    public function getEmailListsForResubscribe(): Collection
    {
        return collect($this->input('resubscribe_to_list_ids', []))
            ->map(fn($listId) => EmailList::find($listId));
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
