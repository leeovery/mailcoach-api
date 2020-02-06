<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers;

use Laravel\Passport\Client;

class IndexApiClientController
{
    public function __invoke()
    {
        return view('mailcoach-api::app.settings.apiClients.index', [
            'clients'          => Client::whereRevoked(false)->paginate(),
            'totalClientCount' => Client::whereRevoked(false)->count(),
        ]);
    }
}
