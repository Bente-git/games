<x-app-layout>
    <div class="p-6">
        @include('beheer.nav')

        <h1 class="text-2xl mb-4">Rol wijzigen</h1>

        <form method="POST" action="{{ route('beheer.roles.update', $role) }}">
            @csrf
            @method('PUT')
            <input type="text" name="name" value="{{ old('name', $role->name) }}" class="border rounded">
            @error('name') <p class="text-red-600">{{ $message }}</p> @enderror
            <button type="submit" class="border px-3 rounded">Opslaan</button>
        </form>
    </div>
</x-app-layout>