<?php

namespace Leeovery\MailcoachApi\DTO\Campaign;

use Carbon\Carbon;
use Leeovery\MailcoachApi\Models\EmailList;
use Spatie\DataTransferObject\DataTransferObject;
use Leeovery\MailcoachApi\Http\Api\Requests\CreateCampaignRequest;

class CreateCampaignData extends DataTransferObject
{
    public string $name;

    public string $subject;

    public string $content;

    public EmailList $list;

    public string $fromEmail;

    public string $fromName;

    public ?Carbon $scheduledAt;

    public static function fromRequest(CreateCampaignRequest $request): self
    {
        return new self([
            'name'        => $request->input('name'),
            'subject'     => $request->input('subject'),
            'content'     => $request->input('content'),
            'list'        => $request->getEmailList(),
            'fromEmail'   => $request->input('from_email', ''),
            'fromName'    => $request->input('from_name', ''),
            'scheduledAt' => $request->getScheduledAt(),
        ]);
    }
}