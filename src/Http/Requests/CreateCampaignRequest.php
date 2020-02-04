<?php

namespace Leeovery\MailcoachApi\Http\Requests;

use Carbon\Carbon;
use Illuminate\Validation\Rules\Unique;
use Leeovery\MailcoachApi\Models\Campaign;
use Leeovery\MailcoachApi\Models\EmailList;

class CreateCampaignRequest extends ContactRequest
{
    public function rules()
    {
        return [
            'name'         => [
                'required',
                'alpha_dash',
                new Unique(Campaign::class, 'name'),
            ],
            'subject'      => 'required|string',
            'content'      => 'required|string',
            'list_id'      => 'required|integer|exists:mailcoach_email_lists,id',
            'from_email'   => 'sometimes|email:rfc,dns',
            'from_name'    => 'sometimes|string',
            'scheduled_at' => 'sometimes|nullable|date_format:Y-m-d H:i',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'campaign name',
        ];
    }

    public function getScheduledAt(): ?Carbon
    {
        if (is_null($this->scheduled_at)) {
            return null;
        }

        return Carbon::createFromFormat('Y-m-d H:i', $this->scheduled_at);
    }

    public function getEmailList(): EmailList
    {
        return EmailList::find($this->input('list_id'));
    }
}
