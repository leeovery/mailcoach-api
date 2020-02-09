<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers\Clients;

use Laravel\Passport\Client;

class ClientIndexController
{
    public function __invoke()
    {
        return view('mailcoach-api::app.clients.index', [
            'clients'          => Client::whereRevoked(false)->paginate(),
            'totalClientCount' => Client::whereRevoked(false)->count(),
        ]);
    }
}
