<?php

namespace Leeovery\MailcoachApi\Http\Api\Controllers;

use Leeovery\MailcoachApi\Actions\Campaign\CreateCampaign;
use Leeovery\MailcoachApi\DTO\Campaign\CreateCampaignData;
use Leeovery\MailcoachApi\Http\Api\Requests\CreateCampaignRequest;

class CampaignController
{
    public function store(CreateCampaignRequest $request, CreateCampaign $createCampaign)
    {
        $createCampaign->execute(CreateCampaignData::fromRequest($request));

        return response()->json([], 201);
    }
}
