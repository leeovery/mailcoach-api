<?php

namespace Leeovery\MailcoachApi\Actions\Webhook;

use Leeovery\MailcoachApi\Models\Webhook;
use Spatie\WebhookServer\Events\WebhookCallFailedEvent;

class WebhookCallFailedAction
{
    public function execute(Webhook $webhook, WebhookCallFailedEvent $event)
    {
        $webhook->webhookEvents()->create([
            'status'   => 'failed',
            'url'      => $event->webhookUrl,
            'payload'  => $event->payload,
            'headers'  => $event->headers,
            'attempts' => $event->attempt,
        ]);
    }
}