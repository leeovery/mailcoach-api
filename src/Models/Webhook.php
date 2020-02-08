<?php /** @noinspection PhpUndefinedFieldInspection */

namespace Leeovery\MailcoachApi\Models;

use Illuminate\Database\Eloquent\Model;
use Leeovery\MailcoachApi\Enums\WebhookStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Webhook extends Model
{
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

    public function events(): HasMany
    {
        return $this->hasMany(WebhookEvent::class);
    }

    public function getTriggerListCountAttribute(): int
    {
        return count($this->triggers);
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