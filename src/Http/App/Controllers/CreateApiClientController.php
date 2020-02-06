<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers;

use Laravel\Passport\ClientRepository;
use Leeovery\MailcoachApi\Http\App\Requests\CreateApiClientRequest;

class CreateApiClientController
{
    public function __invoke(CreateApiClientRequest $request, ClientRepository $clientRepository)
    {
        $client = $clientRepository->create(null, $request->name, '');

        flash()->success("API client \"{$client->name}\" was created.");

        return redirect()->route('mailcoach-api.clients');
    }
}