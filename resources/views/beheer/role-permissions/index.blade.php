<x-app-layout>
    <div class="p-6">
        @include('beheer.nav')

        <h1 class="text-2xl mb-4">Permissies per rol</h1>
        <a href="{{ route('beheer.role-permissions.create') }}" class="underline">+ Permissie koppelen</a>

        <table class="mt-4 w-full">
            <tr class="text-left">
                <th>Rol</th><th>Permissie</th><th>Acties</th>
            </tr>
            @foreach ($roles as $role)
                @foreach ($role->permissions as $permission)
                    <tr>
                        <td>{{ $role->name }} (ID {{ $role->id }})</td>
                        <td>{{ $permission->name }} (ID {{ $permission->id }})</td>
                        <td>
                            <form method="POST" action="{{ route('beheer.role-permissions.destroy', [$role, $permission]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="underline text-red-600">Ontkoppel</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    </div>
</x-app-layout>
