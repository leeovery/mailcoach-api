@extends('mailcoach::app.layouts.app', ['title' => 'Webhooks'])

@section('header')
    <nav class="breadcrumbs">
        <ul>
            <li>
                Webhooks
            </li>
        </ul>
    </nav>
@endsection

@section('content')
    <section class="card">
        <div class="table-actions">
            <button class="button" data-modal-trigger="create-client">
                <x-icon-label icon="far fa-bolt" text="Create new webhook"/>
            </button>

            <x-modal title="Create webhook" name="create-client" :open="$errors->any()">
                @include('mailcoach-api::app.webhooks.partials.create')
            </x-modal>
        </div>

        @if(count($webhooks))
            <table class="table">
                <thead>
                <tr>
                    <x-th sort-by="name" sort-default>Name</x-th>
                    <th>Url</th>
                    <th class="w-32 th-numeric">Triggers</th>
                    <x-th sort-by="-created_at" class="w-48 th-numeric hidden | md:table-cell">Created</x-th>
                    <th class="w-12"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($webhooks as $webhook)
                    <tr>
                        <td class="markup-links">
                            <a class="break-words" href="{{ route('mailcoach-api.webhooks.edit', $webhook) }}">
                                {{ $webhook->name }}
                            </a>
                        </td>
                        <td class="markup-links">
                            <div class="break-words">
                                {{ $webhook->url }}
                            </div>
                        </td>
                        <td class="td-numeric">{{ $webhook->trigger_list_count }}</td>
                        <td class="td-numeric hidden | md:table-cell">
                            {{ $webhook->created_at->toMailcoachFormat() }}
                        </td>
                        <td class="td-action">
                            <div class="dropdown" data-dropdown>
                                <button class="icon-button" data-dropdown-trigger>
                                    <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
                                </button>
                                <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                                    <li>
                                        <x-form-button
                                                :action="route('mailcoach-api.webhooks.delete', $webhook)"
                                                method="DELETE"
                                                data-confirm="true"
                                        >
                                            <x-icon-label icon="fa-trash-alt" text="Delete" :caution="true" />
                                        </x-form-button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <x-table-status
                    name="webhooks"
                    :paginator="$webhooks"
                    :total-count="$totalWebhookCount"
                    :show-all-url="route('mailcoach-api.webhooks')"
            ></x-table-status>

        @else
            <p class="alert alert-info">
                Create Webhooks to connect events (such as email opens, clicks, etc.) to your server in real time.
            </p>
    @endif
@endsection
