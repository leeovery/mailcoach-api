<?php

namespace Leeovery\MailcoachApi\Listeners;

class MailcoachEventListener
{
    public function handle($listener, $event)
    {
        dd($listener, $event);

        // fire webhook as per config
        // create Action to do this, dont do it here.
    }
}