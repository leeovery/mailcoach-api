@extends('mailcoach-api::app.webhooks.layouts.edit', [
    'webhook' => $webhook,
    'titlePrefix' => 'Events Log'
])

@section('breadcrumbs')
    <li>
        <a href="{{ route('mailcoach-api.webhooks.event-log', $webhook) }}">
            <span class="breadcrumb">{{ $webhook->name }}</span>
        </a>
    </li>
    <li><span class="breadcrumb">Event Log</span></li>
@endsection

@section('webhook')
    @if($totalEventLogsCount > 0)
{{--        <div class="table-actions">--}}
{{--            <div class="table-filters">--}}
{{--                <x-search placeholder="Filter opens" />--}}
{{--            </div>--}}
{{--        </div>--}}

        <table class="table table-fixed">
            <thead>
            <tr>
                <x-th sort-by="status" class="">On Event</x-th>
                <x-th sort-by="email">Url</x-th>
                <x-th sort-by="status" class="w-24">Status</x-th>
                <x-th sort-by="attempts" class="w-32 th-numeric">Attempts</x-th>
                <x-th sort-by="-created_at" sort-default class="w-48 th-numeric hidden | md:table-cell">Created At</x-th>
            </tr>
            </thead>
            <tbody>
            @foreach($eventLogs as $eventLog)
                <tr>
                    <td>{{ $eventLog->payload['event'] }}</td>
                    <td class="markup-links">
                        <div class="break-words">
                            {{ $eventLog->url }}
                        </div>
                    </td>
                    <td class="text-center">
                        @if ($eventLog->isSuccess())
                            <i class="fas fa-check text-green-500" title="{{ ucfirst($eventLog->status) }}"></i>
                        @endif
                        @if ($eventLog->isFailure())
                            <i class="fas fa-ban text-orange-500" title="{{ ucfirst($eventLog->status) }}"></i>
                        @endif
                        @if ($eventLog->isFinalFailure())
                            <i class="fas fa-skull-crossbones text-red-500" title="{{ ucfirst($eventLog->status) }}"></i>
                        @endif
                    </td>
                    <td class="td-numeric">{{ $eventLog->attempts }}</td>
                    <td class="td-numeric hidden | md:table-cell">{{ $eventLog->created_at->toMailcoachFormat() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <x-table-status
                name="event"
                :paginator="$eventLogs"
                :total-count="$totalEventLogsCount"
                :show-all-url="route('mailcoach-api.webhooks.event-log', $webhook)"
        ></x-table-status>
    @else
        <p class="alert alert-info">
            No events for this webhook yet.
        </p>
    @endif
@endsection
