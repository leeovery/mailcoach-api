<?php

namespace Leeovery\MailcoachApi\Support;

use Illuminate\Support\Collection;

class Triggers extends Collection
{
    public function events()
    {
        return $this->values();
    }

    public function hasEvent($event)
    {
        return $this->has($event);
    }

    public function getTriggerKey($event)
    {
        return $this->get($event);
    }
}