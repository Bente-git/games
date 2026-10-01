<x-app-layout>
    <div class="p-6">
        @include('beheer.nav')

        <h1 class="text-2xl mb-4">Rollen</h1>
        <a href="{{ route('beheer.roles.create') }}" class="underline">+ Nieuwe rol</a>

        <table class="mt-4 w-full">
            <tr class="text-left">
                <th>ID</th><th>Naam</th><th>Guard</th><th>Acties</th>
            </tr>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    <td class="flex gap-3">
                        <a href="{{ route('beheer.roles.edit', $role) }}" class="underline">Wijzig</a>
                        <form method="POST" action="{{ route('beheer.roles.destroy', $role) }}">
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