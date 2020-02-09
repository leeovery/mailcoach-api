<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers\Webhooks;

use Leeovery\MailcoachApi\Models\Webhook;

class DeactivateWebhookController
{
    public function __invoke(Webhook $webhook)
    {
        $webhook->deactivate();

        flash()->success('The webhook has been deactivated.');

        return redirect()->route('mailcoach-api.webhooks');
    }
}