<?php

namespace Leeovery\MailcoachApi\Actions\Webhook;

use Leeovery\MailcoachApi\Support\Triggers;

class DispatchWebhook
{
    private Triggers $triggers;

    public function __construct(Triggers $triggers)
    {
        $this->triggers = $triggers;
    }

    public function execute($eventName, $eventPayload)
    {
        // a Mailcoach event has occurred.
        // if it appears in the actionmap, lets get the eventKey

        // dd($eventName, $this->triggers);

        if (!$this->triggers->hasEvent($eventName)) {
            dd('NOPE');
        }
        dd('YES');
    }
}