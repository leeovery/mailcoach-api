<?php

namespace Leeovery\MailcoachApi;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Leeovery\MailcoachApi\Skeleton\SkeletonClass
 */
class MailcoachApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mailcoach-api';
    }
}
