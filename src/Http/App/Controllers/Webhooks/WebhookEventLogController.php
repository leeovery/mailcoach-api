<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers\Webhooks;

use Leeovery\MailcoachApi\Models\Webhook;
use Leeovery\MailcoachApi\Http\App\Queries\WebhookEventLogQuery;

class WebhookEventLogController
{
    public function __invoke(Webhook $webhook)
    {
        $webhookEventLogQuery = new WebhookEventLogQuery($webhook);

        return view('mailcoach-api::app.webhooks.events-log', [
            'webhook'             => $webhook,
            'eventLogs'           => $webhookEventLogQuery->paginate(),
            'totalEventLogsCount' => $webhook->webhookEvents()->count(),
        ]);
    }
}