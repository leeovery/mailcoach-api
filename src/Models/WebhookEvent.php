<?php /** @noinspection PhpUndefinedFieldInspection */

namespace Leeovery\MailcoachApi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Leeovery\MailcoachApi\Enums\WebhookEventLogStatus;

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

    public function isSuccess()
    {
        return $this->status === WebhookEventLogStatus::SUCCESS;
    }

    public function isFailure()
    {
        return $this->status === WebhookEventLogStatus::FAILED;
    }

    public function isFinalFailure()
    {
        return $this->status === WebhookEventLogStatus::FINAL_FAIL;
    }
}