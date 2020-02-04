<?php

namespace Leeovery\MailcoachApi\Http\Controllers;

use Illuminate\Http\Request;
use Leeovery\MailcoachApi\Actions\Campaign\CreateCampaign;
use Leeovery\MailcoachApi\DTO\Campaign\CreateCampaignData;
use Leeovery\MailcoachApi\Http\Requests\CreateCampaignRequest;

class CampaignController extends Controller
{
    public function index()
    {
        //
    }

    public function store(CreateCampaignRequest $request, CreateCampaign $createCampaign)
    {
        $createCampaign->execute(CreateCampaignData::fromRequest($request));

        return $this->accepted();
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
