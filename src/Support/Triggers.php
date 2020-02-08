<?php

namespace Leeovery\MailcoachApi\Support;

use Illuminate\Support\Collection;

class Triggers
{
    private Collection $eventMap;

    public function __construct(Collection $eventMap)
    {
        $this->eventMap = $eventMap;
    }

    public function events()
    {
        return $this->eventMap->values();
    }

    public function hasEvent($event)
    {
        return $this->eventMap->has($event);
    }
}