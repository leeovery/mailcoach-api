<?php

namespace Leeovery\MailcoachApi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebhookEvent extends Model
{
    public $table = 'mailcoach_api_webhooks_event_log';

    public $casts = [
        'payload' => 'array',
        'headers' => 'array',
    ];

    protected $guarded = [];

    public function webhook(): BelongsTo
    {
        return $this->belongsTo(Webhook::class);
    }
}