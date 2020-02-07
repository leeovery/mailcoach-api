@extends('mailcoach::app.layouts.app', ['title' => $webhook->name])

@section('header')
    <nav>
        <ul class="breadcrumbs">
            <li>
                <a href="{{ route('mailcoach-api.webhooks') }}">
                    <span class="breadcrumb"> Webhooks</span>
                </a>
            </li>
            <li><span class="breadcrumb">{{ $webhook->name }}</span></li>
        </ul>
    </nav>
@endsection

@section('content')
    <section class="card">
        <form
                class="form-grid"
                action="{{ route('mailcoach-api.webhooks.edit',[$webhook]) }}"
                method="POST"
        >
            @csrf
            @method('PUT')

            <x-text-field label="Name" name="name" :value="$webhook->name" type="name" required/>

            <label class="label">When message is:</label>

            <div class="grid grid-cols-4 gap-4">
                <x-checkbox-field label="Hard Bounced" name="bounce"
                                  :checked="false"/>
                <x-checkbox-field label="Marked as spam" name="track_clicks"
                                  :checked="false"/>
                <x-checkbox-field label="Clicked" name="track_clicks"
                                  :checked="false"/>
                <x-checkbox-field label="Opened" name="track_clicks"
                                  :checked="false"/>
            </div>
            <div class="flex w-full wrap">
                <div class="w-full flex justify-between">
                    <x-checkbox-field label="Hard Bounced" name="bounce"
                                      :checked="false"/>
                    <x-checkbox-field label="Marked as spam" name="track_clicks"
                                      :checked="false"/>
                    <x-checkbox-field label="Clicked" name="track_clicks"
                                      :checked="false"/>
                    <x-checkbox-field label="Opened" name="track_clicks"
                                      :checked="false"/>
                </div>
                <div class="w-full flex justify-between">
                    <x-checkbox-field label="Sent" name="track_clicks"
                                      :checked="false"/>
                    <x-checkbox-field label="Unsubscribed" name="track_clicks"
                                      :checked="false"/>
                    <x-checkbox-field label="Delivered" name="track_clicks"
                                      :checked="false"/>
                </div>
            </div>

            <div class="w-full">
                <label class="label mb-4">When a subscriber:</label>
                <div class="flex -mx-4">
                    <div class="flex-0 px-4">
                        <x-checkbox-field label="Subscribes to a list" name="bounce"
                                          :checked="false"/>
                    </div>
                    <div class="flex-0 px-4">
                        <x-checkbox-field label="Unsubscribes from a list" name="track_clicks"
                                          :checked="false"/>
                    </div>
                    <div class="flex-0 px-4">
                        <x-checkbox-field label="Is Updated" name="track_clicks"
                                          :checked="false"/>
                    </div>
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="button">
                    <x-icon-label icon="fa-chart-pie" text="Save & Activate"/>
                </button>
            </div>
        </form>
    </section>
@endsection
