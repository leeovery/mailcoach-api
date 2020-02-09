@extends('mailcoach::app.layouts.app', [
    'title' => (isset($titlePrefix) ?  $titlePrefix . ' | ' : '') . $webhook->name
])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>
                <a href="{{ route('mailcoach-api.webhooks') }}">
                    <span class="breadcrumb">Webhooks</span>
                </a>
            </li>
            @yield('breadcrumbs')
        </ul>
    </nav>
@endsection

@section('content')
    <nav class="tabs">
        <ul>
            <x-navigation-item :href="route('mailcoach-api.webhooks.edit', $webhook)">
                <x-icon-label icon="fa-cog" text="Settings" />
            </x-navigation-item>
            <x-navigation-item :href="route('mailcoach-api.webhooks.event-log', $webhook)">
                <x-icon-label icon="fa-chart-pie" text="Event Log" :count="$webhook->webhookEvents()->count() ?? 0" />
            </x-navigation-item>
        </ul>
    </nav>

    <section class="card">
        @yield('webhook')
    </section>
@endsection
