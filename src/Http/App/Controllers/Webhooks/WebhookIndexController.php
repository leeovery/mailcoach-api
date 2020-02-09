<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers\Webhooks;

use Leeovery\MailcoachApi\Models\Webhook;
use Leeovery\MailcoachApi\Http\App\Queries\WebhookQuery;

class WebhookIndexController
{
    public function __invoke(WebhookQuery $webhookQuery)
    {
        return view('mailcoach-api::app.webhooks.index', [
            'webhooks'          => $webhookQuery->paginate(),
            'totalWebhookCount' => Webhook::count(),
        ]);
    }
}
