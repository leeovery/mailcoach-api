<?php /** @noinspection PhpUndefinedFieldInspection */

namespace Leeovery\MailcoachApi\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Mailcoach\Models\Concerns\HasUuid;
use Leeovery\MailcoachApi\Enums\WebhookStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Webhook extends Model
{
    use HasUuid;

    public $table = 'mailcoach_api_webhooks';

    public $casts = [
        'triggers' => 'array',
    ];

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Webhook $webhook) {
            if (! $webhook->status) {
                $webhook->status = WebhookStatus::DRAFT;
            }
        });
    }

    public function scopeWithTrigger(Builder $query, $event)
    {
        return $query->where('triggers', 'LIKE', "%\"{$event}\"%");
    }

    public function scopeIsActive(Builder $query)
    {
        return $query->where('status', WebhookStatus::ACTIVATED);
    }

    public function webhookEvents(): HasMany
    {
        return $this->hasMany(WebhookEvent::class);
    }

    public function getTriggerListCountAttribute(): int
    {
        return count($this->triggers ?? []);
    }

    public function hasTrigger($trigger)
    {
        return in_array($trigger, $this->triggers ?? []);
    }

    public function isActive()
    {
        return $this->status === WebhookStatus::ACTIVATED;
    }

    public function isInactive()
    {
        return $this->status === WebhookStatus::DEACTIVATED;
    }

    public function activate()
    {
        $this->status = WebhookStatus::ACTIVATED;
        $this->save();
    }

    public function deactivate()
    {
        $this->status = WebhookStatus::DEACTIVATED;
        $this->save();
    }
}