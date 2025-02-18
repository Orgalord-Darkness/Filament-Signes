<form action="{{ route('language.switch') }}" method="POST" class="inline">
    @csrf
    <select name="locale" onchange="this.form.submit()" class="bg-gray-200 rounded p-2">
        @foreach (config('filament.locales') as $locale => $details)
            <option value="{{ $locale }}" {{ app()->getLocale() == $locale ? 'selected' : '' }}>
                {{ $details['native'] }}
            </option>
        @endforeach
    </select>
</form>