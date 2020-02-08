<?php

namespace Leeovery\MailcoachApi\Actions\Webhook;

use Leeovery\MailcoachApi\Models\Webhook;
use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;

class FinalWebhookCallFailedAction
{
    public function execute(Webhook $webhook, FinalWebhookCallFailedEvent $event)
    {
        $webhook->webhookEvents()->create([
            'status'   => 'final-fail',
            'url'      => $event->webhookUrl,
            'payload'  => $event->payload,
            'headers'  => $event->headers,
            'attempts' => $event->attempt,
        ]);
    }
}