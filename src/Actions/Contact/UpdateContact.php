<?php

namespace Leeovery\MailcoachApi\Actions\Contact;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Leeovery\MailcoachApi\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Leeovery\MailcoachApi\Models\Subscriber;
use Leeovery\MailcoachApi\DTO\Contact\UpdateContactData;

class UpdateContact
{
    protected UpdateContactData $contactData;

    /**
     * @var Collection
     */
    protected Collection $contactSubscriptions;

    public function execute(Contact $contact, UpdateContactData $contactData)
    {
        $this->contactData = $contactData;

        DB::transaction(function () use ($contact) {

            $contact->getSubscriptions()->each(function (Subscriber $subscriber) {
                $subscriber->fill([
                    'email'      => $this->contactData->email ?? $subscriber->email,
                    'first_name' => data_get($this->contactData->attributes, 'first_name', $subscriber->first_name),
                    'last_name'  => data_get($this->contactData->attributes, 'last_name', $subscriber->last_name),
                ]);

                if (filled($this->contactData->attributes)) {
                    $subscriber->extra_attributes = array_filter(
                        array_merge(
                            $subscriber->extra_attributes->all(),
                            Arr::except($this->contactData->attributes, ['first_name', 'last_name'])
                        )
                    );
                }

                if (! $subscriber->isUnsubscribed()) {
                    if ($this->contactData->unsubscribeAll) {
                        $subscriber->unsubscribed_at = now();
                    }

                    if ($this->contactData->lists->pluck('id')->contains($subscriber->email_list_id)) {
                        $subscriber->unsubscribed_at = now();
                    }
                }

                if ($this->contactData->resubscribeAll && $subscriber->isUnsubscribed()) {
                    $subscriber->fill([
                        'subscribed_at'   => now(),
                        'unsubscribed_at' => null,
                    ]);
                }

                $subscriber->save();
            });

        });
    }
}