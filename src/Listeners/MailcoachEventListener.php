<?php

namespace Leeovery\MailcoachApi\Listeners;

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

class MailcoachEventListener
{
    public array $actionMap = [
        BounceRegisteredEvent::class             => '-',
        CampaignLinkClickedEvent::class          => '-',
        CampaignMailSentEvent::class             => '-',
        CampaignOpenedEvent::class               => '-',
        CampaignSentEvent::class                 => '',
        ComplaintRegisteredEvent::class          => '',
        SubscribedEvent::class                   => '',
        UnconfirmedSubscriberCreatedEvent::class => '',
        UnsubscribedEvent::class                 => '',
    ];

    public function handle($listener, $event)
    {
        dd($listener, $event);

        // fire webhook as per config
    }
}