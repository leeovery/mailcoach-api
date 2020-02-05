<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers;

use Laravel\Passport\Client;

class IndexApiClientController
{
    public function __invoke()
    {
        return view('mailcoach-api::app.settings.apiClients.index', [
            'clients'          => $clients = Client::where('revoked', false)->get(),
            'totalClientCount' => $clients->count(),
        ]);
    }
}
