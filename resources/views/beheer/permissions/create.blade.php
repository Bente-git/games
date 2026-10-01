<x-app-layout>
    <div class="p-6">
        @include('beheer.nav')

        <h1 class="text-2xl mb-4">Nieuwe permissie</h1>

        <form method="POST" action="{{ route('beheer.permissions.store') }}">
            @csrf
            <input type="text" name="name" value="{{ old('name') }}" class="border rounded">
            @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
            <button type="submit" class="border px-3 rounded">Opslaan</button>
        </form>
    </div>
</x-app-layout>