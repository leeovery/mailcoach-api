<?php

namespace Leeovery\MailcoachApi\DTO\Contact;

use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObject;
use Leeovery\MailcoachApi\Http\Requests\UpdateContactRequest;

class UpdateContactData extends DataTransferObject
{
    public ?string $email;

    public ?array $attributes;

    public bool $unsubscribeAll;

    public bool $resubscribeAll;

    public Collection $lists;

    public static function fromRequest(UpdateContactRequest $request): self
    {
        return new self([
            'email'          => $request->input('email'),
            'lists'          => $request->getEmailLists(),
            'attributes'     => $request->input('attributes', []),
            'unsubscribeAll' => (bool) $request->input('unsubscribe_all', false),
            'resubscribeAll' => (bool) $request->input('resubscribe_all', false),
        ]);
    }
}