<x-layout>
    <div class="p-4 flex justify-center">
        <h1 class="text-5xl">Káresemény</h1>
    </div>
    <div class="p-4">
        <div>
            <p class="font-bold my-2">{{ $damage_event->location }}</p>
            <p class="font-bold my-2">{{ $damage_event->date }}</p>
            <p>{{ $damage_event->description }}</p>
        </div>
        <div class="my-4">
            @if (Auth::user()->is_admin)
                <form method="GET" action="{{ route('damage-events.edit', ['damage_event' => $damage_event]) }}">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 rounded-lg">Szerkesztés</button>
                </form>
                <form method="POST" action="{{ route('damage-events.destroy', ['damage_event' => $damage_event]) }}"
                    class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 rounded-lg">
                        Törlés
                    </button>
                </form>
            @endif
        </div>
        <hr>
        <div>
            @foreach ($damage_event->vehicles as $vehicle)
                <div class="flex p-4 my-4 bg-red-500 rounded-2xl">
                    <form method="GET" action="{{ route('vehicles.show', ['vehicle' => $vehicle]) }}"
                        class="flex-auto">
                        @csrf
                        <button type="submit" class="w-full">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $vehicle->image) }}" alt=""
                                class="w-24 m-2 border-2 rounded">
                                <p class="m-2 text-white font-bold">{{ $vehicle->license_plate }}</p>
                            </div>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
