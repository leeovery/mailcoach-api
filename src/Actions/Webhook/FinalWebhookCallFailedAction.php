<?php

namespace Leeovery\MailcoachApi\Actions\Webhook;

use Leeovery\MailcoachApi\Models\Webhook;
use Leeovery\MailcoachApi\Enums\WebhookEventLogStatus;
use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;

class FinalWebhookCallFailedAction
{
    public function execute(Webhook $webhook, FinalWebhookCallFailedEvent $event)
    {
        $webhook->webhookEvents()->create([
            'status'   => WebhookEventLogStatus::FINAL_FAIL,
            'url'      => $event->webhookUrl,
            'event'    => $event->payload['event'] ?? '',
            'payload'  => $event->payload,
            'headers'  => $event->headers,
            'attempts' => $event->attempt,
        ]);
    }
}