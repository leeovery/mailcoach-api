@extends('mailcoach::app.layouts.app', ['title' => 'API Clients'])

@section('header')
    <nav class="breadcrumbs">
        <ul>
            <li>
                API Clients
            </li>
        </ul>
    </nav>
@endsection

@section('content')
    <section class="card">
        <div class="table-actions">
            <button class="button" data-modal-trigger="create-template">
                <x-icon-label icon="far fa-bolt" text="Create new API client"/>
            </button>

            <x-modal title="Create API client" name="create-template" :open="$errors->any()">
                @include('mailcoach-api::app.settings.apiClients.partials.create')
            </x-modal>

            <div class=table-filters>
                {{--<x-search placeholder="Filter users…"/>--}}
            </div>
        </div>

        @if(count($clients))
            <table class="table">
                <thead>
                <tr>
                    <x-th sort-by="id" sort-default>Client ID</x-th>
                    <x-th sort-by="name" sort-default>Name</x-th>
                    <x-th sort-by="-active_subscribers_count" class="w-32 th-numeric">Active</x-th>
                    <x-th sort-by="-created_at" class="w-48 th-numeric hidden | md:table-cell">Created</x-th>
                    <th class="w-12"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->id }}</td>
                        <td>{{ $client->name }}</td>
                        <td>state</td>
                        <td class="td-numeric hidden | md:table-cell">
                            {{ $client->created_at->toMailcoachFormat() }}
                        </td>
                        <td class="td-action">
                            <div class="dropdown" data-dropdown>
                                <button class="icon-button" data-dropdown-trigger>
                                    <i class="fas fa-ellipsis-v | dropdown-trigger-rotate"></i>
                                </button>
                                <ul class="dropdown-list dropdown-list-left | hidden" data-dropdown-list>
                                    <li>
                                        <x-form-button
                                                :action="route('mailcoach-api.api-clients.destroy', $client)"
                                                method="DELETE"
                                                data-confirm="true"
                                        >
                                            <x-icon-label icon="fa-trash-alt" text="Revoke" :caution="true" />
                                        </x-form-button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

{{--            <x-table-status--}}
{{--                    name="list"--}}
{{--                    :paginator="$emailLists"--}}
{{--                    :total-count="$totalEmailListsCount"--}}
{{--                    :show-all-url="route('mailcoach.emailLists')"--}}
{{--            ></x-table-status>--}}

        @else
            <p class="alert alert-info">
                You'll need at least one API client to authenticate with the Mailcoach API.
            </p>
        @endif
@endsection
