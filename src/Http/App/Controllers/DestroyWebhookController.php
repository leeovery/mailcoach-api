<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers;

use Leeovery\MailcoachApi\Models\Webhook;

class DestroyWebhookController
{
    public function __invoke(Webhook $webhook)
    {
        $webhook->delete();

        flash()->success("Webhook {$webhook->name} was deleted.");

        return redirect()->route('mailcoach-api.webhooks');
    }
}
