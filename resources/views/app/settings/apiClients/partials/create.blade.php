<form class="form-grid" action="{{ route('mailcoach-api.api-clients.create') }}" method="POST">
    @csrf
    <x-text-field label="Name" name="name" required />

    <div class="form-buttons">
        <button class="button">
            <x-icon-label icon="far fa-bolt" text="Create new API client" />
        </button>
        <button type="button" class="button-cancel" data-modal-dismiss>
            Cancel
        </button>
    </div>
</form>