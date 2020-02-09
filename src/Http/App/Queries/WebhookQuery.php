<?php

namespace Leeovery\MailcoachApi\Http\App\Queries;

use Spatie\QueryBuilder\QueryBuilder;
use Leeovery\MailcoachApi\Models\Webhook;

class WebhookQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Webhook::query()->with('webhookEvents');

        parent::__construct($query);

        $this->defaultSort('name')
             ->allowedSorts('name', 'created_at');
    }
}
