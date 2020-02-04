<?php

namespace Leeovery\MailcoachApi\Http\Resources;

use Leeovery\MailcoachApi\Models\EmailList;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin EmailList
 */
class EmailListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
