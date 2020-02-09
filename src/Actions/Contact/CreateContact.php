<?php /** @noinspection PhpUndefinedMethodInspection */

namespace Leeovery\MailcoachApi\Actions\Contact;

use Illuminate\Support\Facades\DB;
use Leeovery\MailcoachApi\DTO\Contact\CreateContactData;

class CreateContact
{
    public function execute(CreateContactData $contactData)
    {
        DB::transaction(function () use ($contactData) {
            $contactData->lists->each->subscribeContact($contactData);
        });
    }
}