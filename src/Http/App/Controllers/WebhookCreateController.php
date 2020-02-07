<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers;

use Illuminate\Http\Request;
use Leeovery\MailcoachApi\Models\Webhook;

class WebhookCreateController
{
    public function __invoke(Request $request)
    {
        // create pending webhook
        // redirect to page so user can select the events to trigger the webhook on.
        // can save and activate
        // user can also then deactivate webhook, which will essentially switch it off
        // can also be deleted which will delete all the associated webhook logged events

        $webhook = new Webhook([
            'name' => $request->name
        ]);

        $webhook->save();

        flash()->success("Webhook was created.");

        return redirect()->route('mailcoach-api.webhooks.edit', [$webhook]);
    }
}