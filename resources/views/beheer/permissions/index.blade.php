<x-app-layout>
    <div class="p-6">
        @include('beheer.nav')

        <h1 class="text-2xl mb-4">Permissies</h1>
        <a href="{{ route('beheer.permissions.create') }}" class="underline">+ Nieuwe permissie</a>

        <table class="mt-4 w-full">
            <tr class="text-left">
                <th>ID</th><th>Naam</th><th>Guard</th><th>Acties</th>
            </tr>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td class="flex gap-3">
                        <a href="{{ route('beheer.permissions.edit', $permission) }}" class="underline">Wijzig</a>
                        <form method="POST" action="{{ route('beheer.permissions.destroy', $permission) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="underline text-red-600">Verwijder</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-app-layout>
