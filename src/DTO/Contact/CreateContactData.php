<?php

namespace Leeovery\MailcoachApi\DTO\Contact;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObject;
use Leeovery\MailcoachApi\Http\Requests\CreateContactRequest;

class CreateContactData extends DataTransferObject
{
    public string $email;

    public Collection $lists;

    public array $attributes;

    public static function fromRequest(CreateContactRequest $request): self
    {
        return new self([
            'email'      => $request->input('email'),
            'lists'      => $request->getEmailLists(),
            'attributes' => $request->input('attributes', []),
        ]);
    }
}