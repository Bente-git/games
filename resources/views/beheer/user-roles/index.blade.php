<x-app-layout>
    <div class="p-6">
        @include('beheer.nav')

        <h1 class="text-2xl mb-4">Rollen per gebruiker</h1>
        <a href="{{ route('beheer.user-roles.create') }}" class="underline">+ Rol koppelen</a>

        <table class="mt-4 w-full">
            <tr class="text-left">
                <th>Gebruiker</th><th>Rol</th><th>Acties</th>
            </tr>
            @foreach ($users as $user)
                @foreach ($user->roles as $role)
                    <tr>
                        <td>{{ $user->name }} (ID {{ $user->id }})</td>
                        <td>{{ $role->name }} (ID {{ $role->id }})</td>
                        <td>
                            <form method="POST" action="{{ route('beheer.user-roles.destroy', [$user, $role]) }}">
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