<?php

namespace Leeovery\MailcoachApi\Http\Api\Controllers;

use Leeovery\MailcoachApi\Models\EmailList;
use Leeovery\MailcoachApi\Http\Api\Resources\EmailListResource;

class ListController
{
    public function index()
    {
        return EmailListResource::collection(EmailList::all());
    }

    public function show(EmailList $list)
    {
        return EmailListResource::make($list);
    }
}
