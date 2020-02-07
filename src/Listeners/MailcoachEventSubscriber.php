<?php

namespace Leeovery\MailcoachApi\Listeners;

use Illuminate\Events\Dispatcher;
use Spatie\Mailcoach\Events\SubscribedEvent;
use Spatie\Mailcoach\Events\CampaignSentEvent;
use Spatie\Mailcoach\Events\UnsubscribedEvent;
use Spatie\Mailcoach\Events\CampaignOpenedEvent;
use Spatie\Mailcoach\Events\BounceRegisteredEvent;
use Spatie\Mailcoach\Events\CampaignMailSentEvent;
use Spatie\Mailcoach\Events\CampaignLinkClickedEvent;
use Spatie\Mailcoach\Events\ComplaintRegisteredEvent;
use Spatie\Mailcoach\Events\CampaignStatisticsCalculatedEvent;
use Spatie\Mailcoach\Events\UnconfirmedSubscriberCreatedEvent;

class MailcoachEventSubscriber
{
    public function onBounceRegisteredEvent(BounceRegisteredEvent $event)
    {
        dd($event);
    }

    public function onCampaignLinkClickedEvent(CampaignLinkClickedEvent $event)
    {
        dd($event);
    }

    public function onCampaignMailSentEvent(CampaignMailSentEvent $event)
    {
        dd($event);
    }

    public function onCampaignOpenedEvent(CampaignOpenedEvent $event)
    {
        dd($event);
    }

    public function onCampaignSentEvent(CampaignSentEvent $event)
    {
        dd($event);
    }

    public function onCampaignStatisticsCalculatedEvent(CampaignStatisticsCalculatedEvent $event)
    {
        dd($event);
    }

    public function onComplaintRegisteredEvent(ComplaintRegisteredEvent $event)
    {
        dd($event);
    }

    public function onSubscribedEvent(ComplaintRegisteredEvent $event)
    {
        dd($event);
    }

    public function onUnconfirmedSubscriberCreatedEvent(UnconfirmedSubscriberCreatedEvent $event)
    {
        dd($event);
    }

    public function onUnsubscribedEvent(UnsubscribedEvent $event)
    {
        dd($event);
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            BounceRegisteredEvent::class,
            MailcoachEventSubscriber::class.'@onBounceRegisteredEvent'
        );
        $events->listen(
            CampaignLinkClickedEvent::class,
            MailcoachEventSubscriber::class.'@onCampaignLinkClickedEvent'
        );
        $events->listen(
            CampaignMailSentEvent::class,
            MailcoachEventSubscriber::class.'@onCampaignMailSentEvent'
        );
        $events->listen(
            CampaignOpenedEvent::class,
            MailcoachEventSubscriber::class.'@onCampaignOpenedEvent'
        );
        $events->listen(
            CampaignSentEvent::class,
            MailcoachEventSubscriber::class.'@onCampaignSentEvent'
        );
        $events->listen(
            CampaignStatisticsCalculatedEvent::class,
            MailcoachEventSubscriber::class.'@onCampaignStatisticsCalculatedEvent'
        );
        $events->listen(
            ComplaintRegisteredEvent::class,
            MailcoachEventSubscriber::class.'@onComplaintRegisteredEvent'
        );
        $events->listen(
            SubscribedEvent::class,
            MailcoachEventSubscriber::class.'@onSubscribedEvent'
        );
        $events->listen(
            UnconfirmedSubscriberCreatedEvent::class,
            MailcoachEventSubscriber::class.'@onUnconfirmedSubscriberCreatedEvent'
        );
        $events->listen(
            UnsubscribedEvent::class,
            MailcoachEventSubscriber::class.'@onUnsubscribedEvent'
        );
    }
}