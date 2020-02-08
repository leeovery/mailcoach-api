<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers;

use Leeovery\MailcoachApi\Models\Webhook;

class ActivateWebhookController
{
    public function __invoke(Webhook $webhook)
    {
        $webhook->activate();

        flash()->success('The webhook has been activated.');

        return redirect()->route('mailcoach-api.webhooks');
    }
}