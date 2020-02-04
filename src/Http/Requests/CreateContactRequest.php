<?php

namespace Leeovery\MailcoachApi\Http\Requests;

class CreateContactRequest extends ContactRequest
{
    public function rules()
    {
        return [
            'email'        => 'required|email:rfc,dns',
            'list_ids'     => 'required|array',
            'list_ids.*'   => 'integer|exists:mailcoach_email_lists,id',
            'attributes'   => 'nullable|array',
            'attributes.*' => 'string',
        ];
    }
}
