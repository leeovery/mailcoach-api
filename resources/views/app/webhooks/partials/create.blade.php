<form class="form-grid" action="{{ route('mailcoach-api.webhooks.create') }}" method="POST">
    @csrf
    <x-text-field label="Name" name="name" required />

    <div class="form-buttons">
        <button class="button">
            <x-icon-label icon="fas fa-satellite-dish" text="Create webhook"/>
        </button>
        <button type="button" class="button-cancel" data-modal-dismiss>
            Cancel
        </button>
    </div>
</form>
