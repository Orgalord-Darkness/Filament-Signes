<div>
    {{-- The whole world belongs to you. --}}
    <form wire:submit.prevent="submitForm">
    {{ $this->form }}

    <button type="button" wire:click="saveDraft">Sauvegarder en brouillon</button>
    <button type="submit">Soumettre</button>
</form>
</div>
