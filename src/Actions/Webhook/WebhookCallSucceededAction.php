<?php

namespace Leeovery\MailcoachApi\Actions\Webhook;

use Leeovery\MailcoachApi\Models\Webhook;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;

class WebhookCallSucceededAction
{
    public function execute(Webhook $webhook, WebhookCallSucceededEvent $event)
    {
        $webhook->webhookEvents()->create([
            'status'   => 'success',
            'url'      => $event->webhookUrl,
            'payload'  => $event->payload,
            'headers'  => $event->headers,
            'attempts' => $event->attempt,
        ]);
    }
}