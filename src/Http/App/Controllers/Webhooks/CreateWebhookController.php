<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers\Webhooks;

use Leeovery\MailcoachApi\Models\Webhook;
use Leeovery\MailcoachApi\Http\App\Requests\CreateWebhookRequest;

class CreateWebhookController
{
    public function __invoke(CreateWebhookRequest $request)
    {
        $webhook = Webhook::create([
            'name' => $request->name,
        ]);

        flash()->success("A new draft webhook was created.");

        return redirect()->route('mailcoach-api.webhooks.edit', [$webhook]);
    }
}