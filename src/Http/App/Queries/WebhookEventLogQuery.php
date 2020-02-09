<?php

namespace Leeovery\MailcoachApi\Http\App\Queries;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Leeovery\MailcoachApi\Models\Webhook;
use Spatie\Mailcoach\Http\App\Queries\Filters\FuzzyFilter;

class WebhookEventLogQuery extends QueryBuilder
{
    public function __construct(Webhook $webhook)
    {
        $query = $webhook->webhookEvents()->getQuery();

        parent::__construct($query);

        $this
            ->defaultSort('-created_at')
            ->allowedSorts('event', 'status', 'attempts', 'created_at')
            ->allowedFilters(
                AllowedFilter::custom('search', new FuzzyFilter('event')),
            );
    }
}
