<?php /** @noinspection PhpUndefinedMethodInspection */

namespace Leeovery\MailcoachApi\Http\Resources;

use Leeovery\MailcoachApi\Models\Contact;
use Leeovery\MailcoachApi\Models\Subscriber;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Contact
 */
class ContactResource extends JsonResource
{
    public function toArray($request)
    {
        $subscriptions = $this->getSubscriptions();

        return [
            'email'             => $subscriptions->first()->email,
            'first_name'        => $subscriptions->first()->first_name,
            'last_name'         => $subscriptions->first()->last_name,
            'extra_attributes'  => $subscriptions->first()->extra_attributes,
            'subscribed_to'     => $subscriptions->filter->isSubscribed()->map(function (Subscriber $contact) {
                return [
                    'list_id'         => $contact->email_list_id,
                    'subscription_id' => $contact->id,
                    'subscribed_at'   => $contact->subscribed_at,
                ];
            })->values(),
            'unsubscribed_from' => $subscriptions->filter->isUnsubscribed()->map(function (Subscriber $contact) {
                return [
                    'list_id'         => $contact->email_list_id,
                    'subscription_id' => $contact->id,
                    'subscribed_at'   => $contact->subscribed_at,
                    'unsubscribed_at' => $contact->unsubscribed_at,
                ];
            })->values(),
        ];
    }
}
