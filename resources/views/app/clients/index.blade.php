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
            <button class="button" data-modal-trigger="create-client">
                <x-icon-label icon="far fa-bolt" text="Create new API client"/>
            </button>

            <x-modal title="Create API client" name="create-client" :open="$errors->any()">
                @include('mailcoach-api::app.clients.partials.create')
            </x-modal>
        </div>

        @if(count($clients))
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Client ID</th>
                    <th>Secret</th>
                    <th class="w-48 th-numeric hidden | md:table-cell">Created</th>
                    <th class="w-12"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->id }}</td>
                        <td>
                            <button class="button px-2 h-8" data-modal-trigger="show-secret-{{ $client->id }}">
                                <x-icon-label text="Show secret"/>
                            </button>
                            <x-modal title="Client Secret" :name="'show-secret-'.$client->id">
                                @include('mailcoach-api::app.clients.partials.showSecret')
                            </x-modal>
                        </td>
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
                                                :action="route('mailcoach-api.clients.delete', $client)"
                                                method="DELETE"
                                                data-confirm="true"
                                        >
                                            <x-icon-label icon="fa-trash-alt" text="Revoke" :caution="true"/>
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
                    name="client"
                    :paginator="$clients"
                    :total-count="$totalClientCount"
                    :show-all-url="route('mailcoach-api.clients')"
            ></x-table-status>

        @else
            <p class="alert alert-info">
                You'll need at least one API client to authenticate with the Mailcoach API.
            </p>
    @endif
@endsection
