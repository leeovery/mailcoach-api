<?php

namespace Leeovery\MailcoachApi\Listeners;

use Leeovery\MailcoachApi\Actions\Webhook\DispatchWebhook;

class MailcoachEventListener
{
    private DispatchWebhook $dispatchWebhook;

    public function __construct(DispatchWebhook $dispatchWebhook)
    {
        $this->dispatchWebhook = $dispatchWebhook;
    }

    public function handle($eventName, $eventPayload)
    {
        $this->dispatchWebhook->execute($eventName, $eventPayload[0]);
    }
}