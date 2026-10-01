<x-app-layout>
    <div class="p-6">
        @include('beheer.nav')

        <h1 class="text-2xl mb-4">Rol koppelen aan gebruiker</h1>

        <form method="POST" action="{{ route('beheer.user-roles.store') }}">
            @csrf

            <label>Gebruiker</label>
            <select name="user_id" class="border rounded">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->id }} - {{ $user->name }}</option>
                @endforeach
            </select>

            <label>Rol</label>
            <select name="role_id" class="border rounded">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->id }} - {{ $role->name }}</option>
                @endforeach
            </select>

            @error('user_id') <p class="text-red-600">{{ $message }}</p> @enderror
            @error('role_id') <p class="text-red-600">{{ $message }}</p> @enderror

            <button type="submit" class="border px-3 rounded">Koppelen</button>
        </form>
    </div>
</x-app-layout>
