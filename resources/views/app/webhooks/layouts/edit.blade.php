@extends('mailcoach::app.layouts.app', [
    'title' => $webhook->name
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
    <section class="card">
        @yield('webhook')
    </section>
@endsection
