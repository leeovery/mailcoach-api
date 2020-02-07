<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers;

use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class WebhookDestroyController
{
    public function __invoke(Client $client, ClientRepository $clientRepository)
    {
        $clientRepository->delete($client);

        flash()->success("API client \"{$client->name}\" was deleted.");

        return redirect()->route('mailcoach-api.clients');
    }
}
