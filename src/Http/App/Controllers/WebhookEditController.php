<?php

namespace Leeovery\MailcoachApi\Http\App\Controllers;

use Spatie\Mailcoach\Models\EmailList;
use Spatie\Mailcoach\Models\TagSegment;
use Leeovery\MailcoachApi\Models\Webhook;
use Spatie\Mailcoach\Http\App\Requests\UpdateSegmentRequest;

class WebhookEditController
{
    public function edit(Webhook $webhook)
    {
        return view('mailcoach-api::app.webhooks.edit', [
            'webhook' => $webhook,
        ]);
    }

    public function update(EmailList $emailList, TagSegment $segment, UpdateSegmentRequest $request)
    {
        $segment->update([
            'name'                       => $request->name,
            'all_positive_tags_required' => $request->allPositiveTagsRequired(),
            'all_negative_tags_required' => $request->allNegativeTagsRequired(),
        ]);

        $segment
            ->syncPositiveTags($request->positive_tags ?? [])
            ->syncNegativeTags($request->negative_tags ?? []);

        flash()->success('The segment has been updated.');

        return redirect()->route('mailcoach.emailLists.segment.subscribers', [$emailList, $segment]);
    }
}