<?php

namespace Leeovery\MailcoachApi\Http\Requests;

use Illuminate\Support\Collection;
use Illuminate\Foundation\Http\FormRequest;
use Leeovery\MailcoachApi\Models\EmailList;

class ContactRequest extends FormRequest
{
    public function getEmailLists(): Collection
    {
        return collect($this->input('list_ids', []))
            ->map(fn($listId) => EmailList::find($listId));
    }
}