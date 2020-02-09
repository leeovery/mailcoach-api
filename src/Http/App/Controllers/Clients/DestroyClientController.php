<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers\Clients;

use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;

class DestroyClientController
{
    public function __invoke(Client $client, ClientRepository $clientRepository)
    {
        $clientRepository->delete($client);

        flash()->success("API client \"{$client->name}\" was deleted.");

        return redirect()->route('mailcoach-api.clients');
    }
}
