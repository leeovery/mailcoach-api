<?php

namespace Leeovery\MailcoachApi\Http\Api\Requests;

use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Foundation\Http\FormRequest;
use Leeovery\MailcoachApi\Models\EmailList;

class CreateContactRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email'        => 'required|email:rfc,dns',
            'list_ids'     => 'required|array',
            'list_ids.*'   => ['required', 'integer', new Exists(EmailList::class, 'id')],
            'attributes'   => 'nullable|array',
            'attributes.*' => 'string',
        ];
    }

    public function attributes()
    {
        return [
            'list_ids.*' => 'list ID',
        ];
    }

    public function getEmailLists(): Collection
    {
        return collect($this->input('list_ids', []))
            ->map(fn($listId) => EmailList::find($listId));
    }
}
