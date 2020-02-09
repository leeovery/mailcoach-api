<?php

namespace Leeovery\MailcoachApi\Actions\Webhook;

use Leeovery\MailcoachApi\Models\Webhook;
use Leeovery\MailcoachApi\Enums\WebhookEventLogStatus;
use Spatie\WebhookServer\Events\WebhookCallFailedEvent;

class WebhookCallFailedAction
{
    public function execute(Webhook $webhook, WebhookCallFailedEvent $event)
    {
        $webhook->webhookEvents()->create([
            'status'   => WebhookEventLogStatus::FAILED,
            'url'      => $event->webhookUrl,
            'payload'  => $event->payload,
            'headers'  => $event->headers,
            'attempts' => $event->attempt,
        ]);
    }
}