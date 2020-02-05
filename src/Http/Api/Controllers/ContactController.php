<?php

namespace Leeovery\MailcoachApi\Http\Api\Controllers;

use Leeovery\MailcoachApi\Models\Contact;
use Leeovery\MailcoachApi\Actions\Contact\CreateContact;
use Leeovery\MailcoachApi\DTO\Contact\CreateContactData;
use Leeovery\MailcoachApi\Actions\Contact\UpdateContact;
use Leeovery\MailcoachApi\DTO\Contact\UpdateContactData;
use Leeovery\MailcoachApi\Http\Api\Resources\ContactResource;
use Leeovery\MailcoachApi\Http\Api\Requests\CreateContactRequest;
use Leeovery\MailcoachApi\Http\Api\Requests\UpdateContactRequest;

class ContactController
{
    public function store(CreateContactRequest $request, CreateContact $createContact)
    {
        $createContact->execute(CreateContactData::fromRequest($request));

        return response()->json([], 201);
    }

    public function show(Contact $contact)
    {
        return ContactResource::make($contact);
    }

    public function update(UpdateContactRequest $request, Contact $contact, UpdateContact $updateContact)
    {
        $updateContact->execute($contact, UpdateContactData::fromRequest($request));

        return response()->json([], 202);
    }
}
