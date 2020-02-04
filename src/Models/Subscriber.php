<?php

namespace Leeovery\MailcoachApi\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Spatie\Mailcoach\Models\Tag;
use Spatie\Mailcoach\Models\Send;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Mailcoach\Models\CampaignOpen;
use Spatie\Mailcoach\Models\CampaignClick;
use Illuminate\Database\Eloquent\Collection;
use Spatie\SchemalessAttributes\SchemalessAttributes;
use Spatie\Mailcoach\Models\Subscriber as MailcoachSubscriber;

/**
 * @property int                                     $id
 * @property int                                     $email_list_id
 * @property string                                  $email
 * @property string|null                             $first_name
 * @property string|null                             $last_name
 * @property string|null                             $full_name
 * @property SchemalessAttributes|array|null         $extra_attributes
 * @property string                                  $uuid
 * @property Carbon|null                             $subscribed_at
 * @property Carbon|null                             $unsubscribed_at
 * @property Carbon|null                             $created_at
 * @property Carbon|null                             $updated_at
 * @property-read Collection|CampaignClick[]         $clicks
 * @property-read int|null                           $clicks_count
 * @property-read \Spatie\Mailcoach\Models\EmailList $emailList
 * @property-read mixed                              $status
 * @property-read Collection|CampaignOpen[]          $opens
 * @property-read int|null                           $opens_count
 * @property-read Collection|Send[]                  $sends
 * @property-read int|null                           $sends_count
 * @property-read Collection|Tag[]                   $tags
 * @property-read int|null                           $tags_count
 * @property-read Collection|CampaignClick[]         $uniqueClicks
 * @property-read int|null                           $unique_clicks_count
 * @method static Builder|Subscriber newModelQuery()
 * @method static Builder|Subscriber newQuery()
 * @method static Builder|Subscriber query()
 * @method static Builder|MailcoachSubscriber subscribed()
 * @method static Builder|MailcoachSubscriber unconfirmed()
 * @method static Builder|MailcoachSubscriber unsubscribed()
 * @method static Builder|Subscriber whereCreatedAt($value)
 * @method static Builder|Subscriber whereEmail($value)
 * @method static Builder|Subscriber whereEmailListId($value)
 * @method static Builder|Subscriber whereExtraAttributes($value)
 * @method static Builder|Subscriber whereFirstName($value)
 * @method static Builder|Subscriber whereFullName($value)
 * @method static Builder|Subscriber whereId($value)
 * @method static Builder|Subscriber whereLastName($value)
 * @method static Builder|Subscriber whereSubscribedAt($value)
 * @method static Builder|Subscriber whereUnsubscribedAt($value)
 * @method static Builder|Subscriber whereUpdatedAt($value)
 * @method static Builder|Subscriber whereUuid($value)
 * @method static Builder|MailcoachSubscriber withExtraAttributes()
 * @mixin Eloquent
 */
class Subscriber extends MailcoachSubscriber
{
    //
}
