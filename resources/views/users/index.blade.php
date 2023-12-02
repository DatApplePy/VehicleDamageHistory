<x-layout>
    <div class="p-4 flex justify-center">
        <h1 class="text-5xl">Felhasználók</h1>
    </div>
    <div>
        @foreach ($users as $user)
            <div class="flex items-center justify-between p-4 m-4 bg-red-500 rounded-2xl">
                <div class="flex items-center">
                    <p class="m-2 text-white font-bold">{{$user -> name}}</p>
                    <p class="m-2 text-white font-bold">{{$user -> email}}</p>
                    @if ($user -> is_admin)
                        <p class="m-2 text-white font-bold">admin</p>
                    @elseif ($user -> is_premium)
                        <p class="m-2 text-white font-bold">prémium</p>
                    @else
                        <p class="m-2 text-white font-bold">-</p>
                    @endif
                </div>
                @if (!$user -> is_admin)
                    <form method="POST" action="{{route('users.update', ['user' => $user])}}">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="is_premium" value="{{$user -> is_premium ? "0" : "1"}}"
                            class="pl-4 pr-2 text-white">
                            {{$user -> is_premium ? "deactivate premium" : "activate premium"}}
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
</x-layout>