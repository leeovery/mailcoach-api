<?php /** @noinspection PhpUndefinedMethodInspection */

/** @noinspection PhpUnused */

namespace Leeovery\MailcoachApi\Http\App\ViewModels;

use stdClass;
use Illuminate\Support\Str;
use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Collection;
use Leeovery\MailcoachApi\Models\Webhook;
use Leeovery\MailcoachApi\Support\Triggers;

class WebhookViewModel extends ViewModel
{
    protected Webhook $webhook;

    protected Triggers $triggers;

    protected array $subscriberEvents;

    public function __construct(Webhook $webhook, Triggers $triggers)
    {
        $this->webhook = $webhook;
        $this->triggers = $triggers;

        $this->subscriberEvents = [
            'subscribes-with-confirmation', 'unsubscribes', 'subscribes',
        ];
    }

    public function webhook(): Webhook
    {
        return $this->webhook;
    }

    public function messageTriggers(): array
    {
        return $this->triggers->events()
                              ->reject(fn($key) => in_array($key, $this->subscriberEvents))
                              ->pipe($this->makeForView())
                              ->all();
    }

    private function makeForView()
    {
        return function (Collection $events) {
            return $events->map(function ($key) {
                $event = new stdClass();
                $event->key = $key;
                $event->label = Str::kebabToSentence($key);

                return $event;
            });
        };
    }

    public function subscriberTriggers(): array
    {
        return $this->triggers->events()
                              ->filter(fn($key) => in_array($key, $this->subscriberEvents))
                              ->pipe($this->makeForView())
                              ->all();
    }
}
