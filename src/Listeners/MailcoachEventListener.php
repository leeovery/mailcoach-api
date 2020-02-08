<?php

namespace Leeovery\MailcoachApi\Listeners;

use Leeovery\MailcoachApi\Actions\Webhook\DispatchWebhook;

class MailcoachEventListener
{
    /**
     * @var DispatchWebhook
     */
    private DispatchWebhook $dispatchWebhook;

    public function __construct(DispatchWebhook $dispatchWebhook)
    {
        $this->dispatchWebhook = $dispatchWebhook;
    }

    public function handle($eventName, $eventPayload)
    {
        $this->dispatchWebhook->execute($eventName, $eventPayload);
    }
}