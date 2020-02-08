<?php

namespace Leeovery\MailcoachApi\Http\App\Queries;

use Spatie\QueryBuilder\QueryBuilder;
use Leeovery\MailcoachApi\Models\Webhook;

class WebhookEventLogQuery extends QueryBuilder
{
    public function __construct(Webhook $webhook)
    {
        $query = $webhook->webhookEvents()->getQuery();

        parent::__construct($query);

        $this
            ->defaultSort('-created_at');
        // ->allowedFilters(
        //     AllowedFilter::custom('search', new FuzzyFilter('name'))
        // );
    }
}
