<?php

namespace Leeovery\MailcoachApi\Http\Controllers\Api;

use Leeovery\MailcoachApi\Models\Contact;
use Leeovery\MailcoachApi\Http\Controllers\Controller;
use Leeovery\MailcoachApi\DTO\Contact\UpdateContactData;
use Leeovery\MailcoachApi\DTO\Contact\CreateContactData;
use Leeovery\MailcoachApi\Actions\Contact\UpdateContact;
use Leeovery\MailcoachApi\Actions\Contact\CreateContact;
use Leeovery\MailcoachApi\Http\Resources\ContactResource;
use Leeovery\MailcoachApi\Http\Requests\CreateContactRequest;
use Leeovery\MailcoachApi\Http\Requests\UpdateContactRequest;

class ContactController extends Controller
{
    public function store(CreateContactRequest $request, CreateContact $createContact)
    {
        $createContact->execute(CreateContactData::fromRequest($request));

        return $this->accepted();
    }

    public function show(Contact $contact)
    {
        return ContactResource::make($contact);
    }

    public function update(UpdateContactRequest $request, Contact $contact, UpdateContact $updateContact)
    {
        $updateContact->execute($contact, UpdateContactData::fromRequest($request));

        return $this->accepted();
    }

    public function destroy($id)
    {
        // ??
    }
}
