<x-app-layout>
    <div class="p-6">
        @include('beheer.nav')

        <h1 class="text-2xl mb-4">Permissie koppelen aan rol</h1>

        <form method="POST" action="{{ route('beheer.role-permissions.store') }}">
            @csrf

            <label>Rol</label>
            <select name="role_id" class="border rounded">
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->id }} - {{ $role->name }}</option>
                @endforeach
            </select>

            <label>Permissie</label>
            <select name="permission_id" class="border rounded">
                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->id }} - {{ $permission->name }}</option>
                @endforeach
            </select>

            @error('role_id') <p class="text-red-600">{{ $message }}</p> @enderror
            @error('permission_id') <p class="text-red-600">{{ $message }}</p> @enderror

            <button type="submit" class="border px-3 rounded">Koppelen</button>
        </form>
    </div>
</x-app-layout>