<?php

namespace Leeovery\MailcoachApi\Http\Controllers;

use Leeovery\MailcoachApi\Models\EmailList;
use Leeovery\MailcoachApi\Http\Resources\EmailListResource;

class ListController extends Controller
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
