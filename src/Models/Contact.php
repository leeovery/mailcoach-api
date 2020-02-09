<?php

namespace Leeovery\MailcoachApi\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Contact
{
    /**
     * @var Collection
     */
    protected Collection $subscriptions;

    public function resolveRouteBinding($email)
    {
        $this->subscriptions = static::findAllForEmailOrFail($email);

        return $this;
    }

    public static function findAllForEmailOrFail(string $email): Collection
    {
        return tap(Subscriber::whereEmail($email)->get())->whenEmpty(function () use ($email) {
            throw (new ModelNotFoundException)->setModel(Contact::class, $email);
        });
    }

    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }
}
