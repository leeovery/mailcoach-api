<?php

namespace Leeovery\MailcoachApi\Models;

use Eloquent;
use Carbon\Carbon;
use Spatie\Mailcoach\Models\Send;
use Spatie\Mailcoach\Models\TagSegment;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Mailcoach\Models\CampaignOpen;
use Spatie\Mailcoach\Models\CampaignLink;
use Spatie\Mailcoach\Models\CampaignClick;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Mailcoach\Models\SendFeedbackItem;
use Spatie\Mailcoach\Models\CampaignUnsubscribe;
use Spatie\Mailcoach\Models\Campaign as MailcoachCampaign;

/**
 * @property int                                          $id
 * @property string|null                                  $name
 * @property string                                       $uuid
 * @property string|null                                  $from_email
 * @property string|null                                  $from_name
 * @property string|null                                  $subject
 * @property int|null                                     $email_list_id
 * @property string                                       $status
 * @property string|null                                  $html
 * @property string|null                                  $email_html
 * @property string|null                                  $webview_html
 * @property string|null                                  $mailable_class
 * @property bool                                         $track_opens
 * @property bool                                         $track_clicks
 * @property int                                          $sent_to_number_of_subscribers
 * @property string|null                                  $segment_class
 * @property int|null                                     $segment_id
 * @property string                                       $segment_description
 * @property int                                          $open_count
 * @property int                                          $unique_open_count
 * @property int                                          $open_rate
 * @property int                                          $click_count
 * @property int                                          $unique_click_count
 * @property int                                          $click_rate
 * @property int                                          $unsubscribe_count
 * @property int                                          $unsubscribe_rate
 * @property int                                          $bounce_count
 * @property int                                          $bounce_rate
 * @property \Illuminate\Support\Carbon|null              $sent_at
 * @property \Illuminate\Support\Carbon|null              $statistics_calculated_at
 * @property \Illuminate\Support\Carbon|null              $scheduled_at
 * @property \Illuminate\Support\Carbon|null              $last_modified_at
 * @property \Illuminate\Support\Carbon|null              $summary_mail_sent_at
 * @property \Illuminate\Support\Carbon|null              $created_at
 * @property \Illuminate\Support\Carbon|null              $updated_at
 * @property-read Collection|SendFeedbackItem[]           $bounces
 * @property-read int|null                                $bounces_count
 * @property-read Collection|CampaignClick[]              $clicks
 * @property-read int|null                                $clicks_count
 * @property-read Collection|SendFeedbackItem[]           $complaints
 * @property-read int|null                                $complaints_count
 * @property-read \Spatie\Mailcoach\Models\EmailList|null $emailList
 * @property-read Collection|CampaignLink[]               $links
 * @property-read int|null                                $links_count
 * @property-read Collection|CampaignOpen[]               $opens
 * @property-read int|null                                $opens_count
 * @property-read Collection|Send[]                       $sends
 * @property-read int|null                                $sends_count
 * @property-read TagSegment                              $tagSegment
 * @property-read Collection|CampaignUnsubscribe[]        $unsubscribes
 * @property-read int|null                                $unsubscribes_count
 * @method static Builder|MailcoachCampaign draft()
 * @method static Builder|MailcoachCampaign needsSummaryToBeReported()
 * @method static Builder|Campaign newModelQuery()
 * @method static Builder|Campaign newQuery()
 * @method static Builder|Campaign query()
 * @method static Builder|MailcoachCampaign scheduled()
 * @method static Builder|MailcoachCampaign sendingOrSent()
 * @method static Builder|MailcoachCampaign sent()
 * @method static Builder|MailcoachCampaign sentBetween(Carbon $periodStart, Carbon $periodEnd)
 * @method static Builder|MailcoachCampaign sentDaysAgo($daysAgo)
 * @method static Builder|MailcoachCampaign shouldBeSentNow()
 * @method static Builder|Campaign whereBounceCount($value)
 * @method static Builder|Campaign whereBounceRate($value)
 * @method static Builder|Campaign whereClickCount($value)
 * @method static Builder|Campaign whereClickRate($value)
 * @method static Builder|Campaign whereCreatedAt($value)
 * @method static Builder|Campaign whereEmailHtml($value)
 * @method static Builder|Campaign whereEmailListId($value)
 * @method static Builder|Campaign whereFromEmail($value)
 * @method static Builder|Campaign whereFromName($value)
 * @method static Builder|Campaign whereHtml($value)
 * @method static Builder|Campaign whereId($value)
 * @method static Builder|Campaign whereLastModifiedAt($value)
 * @method static Builder|Campaign whereMailableClass($value)
 * @method static Builder|Campaign whereName($value)
 * @method static Builder|Campaign whereOpenCount($value)
 * @method static Builder|Campaign whereOpenRate($value)
 * @method static Builder|Campaign whereScheduledAt($value)
 * @method static Builder|Campaign whereSegmentClass($value)
 * @method static Builder|Campaign whereSegmentDescription($value)
 * @method static Builder|Campaign whereSegmentId($value)
 * @method static Builder|Campaign whereSentAt($value)
 * @method static Builder|Campaign whereSentToNumberOfSubscribers($value)
 * @method static Builder|Campaign whereStatisticsCalculatedAt($value)
 * @method static Builder|Campaign whereStatus($value)
 * @method static Builder|Campaign whereSubject($value)
 * @method static Builder|Campaign whereSummaryMailSentAt($value)
 * @method static Builder|Campaign whereTrackClicks($value)
 * @method static Builder|Campaign whereTrackOpens($value)
 * @method static Builder|Campaign whereUniqueClickCount($value)
 * @method static Builder|Campaign whereUniqueOpenCount($value)
 * @method static Builder|Campaign whereUnsubscribeCount($value)
 * @method static Builder|Campaign whereUnsubscribeRate($value)
 * @method static Builder|Campaign whereUpdatedAt($value)
 * @method static Builder|Campaign whereUuid($value)
 * @method static Builder|Campaign whereWebviewHtml($value)
 * @mixin Eloquent
 */
class Campaign extends MailcoachCampaign
{
    //
}
