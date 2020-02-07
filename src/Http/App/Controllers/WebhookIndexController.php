<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers;

use Leeovery\MailcoachApi\Models\Webhook;

class WebhookIndexController
{
    public function __invoke()
    {
        return view('mailcoach-api::app.webhooks.index', [
            'webhooks'          => Webhook::paginate(),
            'totalWebhookCount' => Webhook::count(),
        ]);
    }
}
