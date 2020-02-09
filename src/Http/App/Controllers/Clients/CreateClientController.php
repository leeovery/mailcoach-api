<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers\Clients;

use Laravel\Passport\ClientRepository;
use Leeovery\MailcoachApi\Http\App\Requests\CreateApiClientRequest;

class CreateClientController
{
    public function __invoke(CreateApiClientRequest $request, ClientRepository $clientRepository)
    {
        $client = $clientRepository->create(null, $request->name, '');

        flash()->success("API client \"{$client->name}\" was created.");

        return redirect()->route('mailcoach-api.clients');
    }
}