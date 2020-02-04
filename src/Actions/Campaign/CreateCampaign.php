<?php

namespace Leeovery\MailcoachApi\Actions\Campaign;

use Leeovery\MailcoachApi\Models\Campaign;
use Leeovery\MailcoachApi\DTO\Campaign\CreateCampaignData;

class CreateCampaign
{
    public function execute(CreateCampaignData $campaignData)
    {
        $campaign = Campaign::create(['name' => $campaignData->name])
                            ->from($campaignData->fromEmail, $campaignData->fromName)
                            ->subject($campaignData->subject)
                            ->content($campaignData->content)
                            ->trackOpens()
                            ->trackClicks()
                            ->to($campaignData->list);

        if (! is_null($campaignData->scheduledAt)) {
            $campaign->scheduleToBeSentAt($campaignData->scheduledAt);
        } else {
            $campaign->send();
        }
    }
}