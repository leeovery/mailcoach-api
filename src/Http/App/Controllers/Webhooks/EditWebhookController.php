<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers\Webhooks;

use Leeovery\MailcoachApi\Models\Webhook;
use Leeovery\MailcoachApi\Support\Triggers;
use Leeovery\MailcoachApi\Http\App\ViewModels\WebhookViewModel;
use Leeovery\MailcoachApi\Http\App\Requests\UpdateWebhookRequest;

class EditWebhookController
{
    public function edit(Webhook $webhook, Triggers $triggers)
    {
        $viewModel = new WebhookViewModel($webhook, $triggers);

        return view('mailcoach-api::app.webhooks.settings', $viewModel);
    }

    public function update(Webhook $webhook, UpdateWebhookRequest $request)
    {
        $webhook->update([
            'name'     => $request->name,
            'url'      => $request->url,
            'triggers' => $request->triggers,
        ]);

        $webhook->activate();

        flash()->success('The webhook has been updated & activated.');

        return redirect()->route('mailcoach-api.webhooks');
    }
}