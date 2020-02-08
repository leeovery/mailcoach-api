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
                action="{{ route('mailcoach-api.webhooks.edit', [$webhook]) }}"
                method="POST"
        >
            @csrf
            @method('PUT')

            <x-text-field label="Name" name="name" :value="$webhook->name" type="name" required/>

            <x-text-field label="Url" name="url" :value="$webhook->url" type="name" required/>

            <hr class="border-t-2 border-gray-200 my-8">

            <h2 class="markup-h2">Trigger webhook on these triggers:</h2>

            <x-help>
                The url you specify above will be hit when the checked event(s) occur.
            </x-help>

            @error('triggers')
            <p class="form-error">{{ $message }}</p>
            @enderror

            <div class="flex w-full">

                <div class="w-1/2 flex flex-col align-start form-row">
                    <label class="label mb-4">When a message is…</label>
                    <div class="checkbox-group">
                        @foreach ($messageTriggers as $trigger)
                            <x-checkbox-field
                                    :label="$trigger->label"
                                    :name="'triggers['.$trigger->key.']'"
                                    :checked="$webhook->hasTrigger($trigger->key)"
                            />
                        @endforeach
                    </div>
                </div>

                <div class="w-1/2 flex flex-col align-start form-row">
                    <label class="label mb-4">When a subscriber…</label>
                    <div class="checkbox-group">
                        @foreach ($subscriberTriggers as $trigger)
                            <x-checkbox-field
                                    :label="$trigger->label"
                                    :name="'triggers['.$trigger->key.']'"
                                    :checked="$webhook->hasTrigger($trigger->key)"
                            />
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-buttons">
                <button type="submit" class="button">
                    <x-icon-label icon="fas fa-play" text="Save & Activate"/>
                </button>
            </div>
        </form>
    </section>
@endsection
