<?php

namespace Leeovery\MailcoachApi\Models;

use Eloquent;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Spatie\Mailcoach\Models\Tag;
use Spatie\Mailcoach\Models\Campaign;
use Spatie\Mailcoach\Models\TagSegment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Mailcoach\Models\SubscriberImport;
use Leeovery\MailcoachApi\DTO\Contact\CreateContactData;
use Spatie\Mailcoach\Models\EmailList as MailcoachEmailList;

/**
 * @property int                                $id
 * @property string                             $uuid
 * @property string                             $name
 * @property string                             $campaigns_feed_enabled
 * @property string|null                        $default_from_email
 * @property string|null                        $default_from_name
 * @property bool                               $allow_form_subscriptions
 * @property string|null                        $redirect_after_subscribed
 * @property string|null                        $redirect_after_already_subscribed
 * @property string|null                        $redirect_after_subscription_pending
 * @property string|null                        $redirect_after_unsubscribed
 * @property bool                               $requires_confirmation
 * @property string|null                        $confirmation_mail_subject
 * @property string|null                        $confirmation_mail_content
 * @property string|null                        $confirmation_mailable_class
 * @property bool|null                          $send_welcome_mail
 * @property string|null                        $welcome_mail_subject
 * @property string|null                        $welcome_mail_content
 * @property string|null                        $welcome_mailable_class
 * @property string|null                        $report_recipients
 * @property bool                               $report_campaign_sent
 * @property bool                               $report_campaign_summary
 * @property bool                               $report_email_list_summary
 * @property Carbon|null                        $email_list_summary_sent_at
 * @property Carbon|null                        $created_at
 * @property Carbon|null                        $updated_at
 * @property-read Collection|Subscriber[]       $allSubscribers
 * @property-read int|null                      $all_subscribers_count
 * @property-read Collection|Tag[]              $allowedFormSubscriptionTags
 * @property-read int|null                      $allowed_form_subscription_tags_count
 * @property-read Collection|Campaign[]         $campaigns
 * @property-read int|null                      $campaigns_count
 * @property-read Collection|TagSegment[]       $segments
 * @property-read int|null                      $segments_count
 * @property-read Collection|SubscriberImport[] $subscriberImports
 * @property-read int|null                      $subscriber_imports_count
 * @property-read Collection|Subscriber[]       $subscribers
 * @property-read int|null                      $subscribers_count
 * @property-read Collection|Tag[]              $tags
 * @property-read int|null                      $tags_count
 * @method static Builder|EmailList newModelQuery()
 * @method static Builder|EmailList newQuery()
 * @method static Builder|EmailList query()
 * @method static Builder|MailcoachEmailList summarySentMoreThanDaysAgo($days)
 * @method static Builder|EmailList whereAllowFormSubscriptions($value)
 * @method static Builder|EmailList whereCampaignsFeedEnabled($value)
 * @method static Builder|EmailList whereConfirmationMailContent($value)
 * @method static Builder|EmailList whereConfirmationMailSubject($value)
 * @method static Builder|EmailList whereConfirmationMailableClass($value)
 * @method static Builder|EmailList whereCreatedAt($value)
 * @method static Builder|EmailList whereDefaultFromEmail($value)
 * @method static Builder|EmailList whereDefaultFromName($value)
 * @method static Builder|EmailList whereEmailListSummarySentAt($value)
 * @method static Builder|EmailList whereId($value)
 * @method static Builder|EmailList whereName($value)
 * @method static Builder|EmailList whereRedirectAfterAlreadySubscribed($value)
 * @method static Builder|EmailList whereRedirectAfterSubscribed($value)
 * @method static Builder|EmailList whereRedirectAfterSubscriptionPending($value)
 * @method static Builder|EmailList whereRedirectAfterUnsubscribed($value)
 * @method static Builder|EmailList whereReportCampaignSent($value)
 * @method static Builder|EmailList whereReportCampaignSummary($value)
 * @method static Builder|EmailList whereReportEmailListSummary($value)
 * @method static Builder|EmailList whereReportRecipients($value)
 * @method static Builder|EmailList whereRequiresConfirmation($value)
 * @method static Builder|EmailList whereSendWelcomeMail($value)
 * @method static Builder|EmailList whereUpdatedAt($value)
 * @method static Builder|EmailList whereUuid($value)
 * @method static Builder|EmailList whereWelcomeMailContent($value)
 * @method static Builder|EmailList whereWelcomeMailSubject($value)
 * @method static Builder|EmailList whereWelcomeMailableClass($value)
 * @mixin Eloquent
 */
class EmailList extends MailcoachEmailList
{
    public function subscribeContact(CreateContactData $contactData)
    {
        Subscriber::createWithEmail($contactData->email)
                  ->skipConfirmation()
                  ->doNotSendWelcomeMail()
                  ->withAttributes([
                      'first_name'       => data_get($contactData->attributes, 'first_name', ''),
                      'last_name'        => data_get($contactData->attributes, 'last_name', ''),
                      'extra_attributes' => Arr::except($contactData->attributes, ['first_name', 'last_name']),
                  ])
                  ->subscribeTo($this);
    }
}
