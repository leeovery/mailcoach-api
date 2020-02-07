@extends('mailcoach-api::app.webhooks.layouts.edit', ['webhook' => $webhook])

@section('breadcrumbs')
    <li><span class="breadcrumb">{{ $webhook->name }}</span></li>
@endsection

@section('webhook')
    hello
    <form
            class="form-grid"
            action="{{ route('mailcoach.emailLists.segment.edit',[$segment->emailList, $segment]) }}"
            method="POST"
    >
        @if (! $emailList->tags()->count())
            <div class="alert alert-info markup-lists">
                A segment is based on tags.
                <ol class="mt-4">
                    <li><a href={{ route('mailcoach.emailLists.tags', $emailList) }}>Create some tags</a> for this list first.</li>
                    <li>Assign these tags to some of the <a href={{ route('mailcoach.emailLists.subscribers', $emailList) }}>subscribers</a>.</li>
                </ol>
            </div>
        @endif

        @csrf
        @method('PUT')

        <x-text-field label="Name" name="name" :value="$segment->name" type="name" required />

        <div class="form-row">
            <label class=label>Include with tags</label>
            <div class="flex items-end">
                <div class="flex-none">
                    <x-select-field
                            name="positive_tags_operator"
                            :value="$segment->all_positive_tags_required ? 'all' : 'any'"
                            :options="['any' => 'Any', 'all' => 'All']"
                    />
                </div>
                <div class="ml-2 flex-grow">
                    <x-tags-field
                            name="positive_tags"
                            :value="$segment->positiveTags()->pluck('name')->toArray()"
                            :tags="$emailList->tags()->pluck('name')->toArray()"
                    />
                </div>
            </div>
        </div>

        <div class="form-row">
            <label class=label>Exclude with tags</label>
            <div class="flex items-end">
                <div class="flex-none">
                    <x-select-field
                            name="negative_tags_operator"
                            :value="$segment->all_negative_tags_required ? 'all' : 'any'"
                            :options="['any' => 'Any', 'all' => 'All']"
                    />
                </div>
                <div class="ml-2 flex-grow">
                    <x-tags-field
                            name="negative_tags"
                            :value="$segment->negativeTags()->pluck('name')->toArray()"
                            :tags="$emailList->tags()->pluck('name')->toArray()"
                    />
                </div>
            </div>
        </div>


        <div class="form-buttons">
            <button type="submit" class="button">
                <x-icon-label icon="fa-chart-pie" text="Save" />
            </button>
        </div>
    </form>
@endsection
