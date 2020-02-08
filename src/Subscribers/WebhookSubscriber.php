<?php /** @noinspection PhpUnused */

/** @noinspection PhpIncompatibleReturnTypeInspection */

namespace Leeovery\MailcoachApi\Subscribers;

use Leeovery\MailcoachApi\Models\Webhook;
use Spatie\WebhookServer\Events\WebhookCallEvent;
use Spatie\WebhookServer\Events\WebhookCallFailedEvent;
use Spatie\WebhookServer\Events\WebhookCallSucceededEvent;
use Spatie\WebhookServer\Events\FinalWebhookCallFailedEvent;
use Leeovery\MailcoachApi\Actions\Webhook\WebhookCallFailedAction;
use Leeovery\MailcoachApi\Actions\Webhook\WebhookCallSucceededAction;
use Leeovery\MailcoachApi\Actions\Webhook\FinalWebhookCallFailedAction;

class WebhookSubscriber
{
    public function handleWebhookCallSucceeded(WebhookCallSucceededEvent $event)
    {
        if (is_null($webhook = $this->getWebhookFromEvent($event))) {
            return;
        }

        /** @var WebhookCallSucceededAction $action */
        $action = app(WebhookCallSucceededAction::class);

        $action->execute($webhook, $event);
    }

    private function getWebhookFromEvent(WebhookCallEvent $event): ?Webhook
    {
        return Webhook::findByUuid($event->meta['webhook_id']);
    }

    public function handleWebhookCallFailed(WebhookCallFailedEvent $event)
    {
        if (is_null($webhook = $this->getWebhookFromEvent($event))) {
            return;
        }

        /** @var WebhookCallFailedAction $action */
        $action = app(WebhookCallFailedAction::class);

        $action->execute($webhook, $event);
    }

    public function handleFinalWebhookCallFailed(FinalWebhookCallFailedEvent $event)
    {
        if (is_null($webhook = $this->getWebhookFromEvent($event))) {
            return;
        }

        /** @var FinalWebhookCallFailedAction $action */
        $action = app(FinalWebhookCallFailedAction::class);

        $action->execute($webhook, $event);
    }

    public function subscribe($events)
    {
        $events->listen(
            WebhookCallSucceededEvent::class,
            WebhookSubscriber::class.'@handleWebhookCallSucceeded'
        );
        $events->listen(
            WebhookCallFailedEvent::class,
            WebhookSubscriber::class.'@handleWebhookCallFailed'
        );
        $events->listen(
            FinalWebhookCallFailedEvent::class,
            WebhookSubscriber::class.'@handleFinalWebhookCallFailed'
        );
    }
}