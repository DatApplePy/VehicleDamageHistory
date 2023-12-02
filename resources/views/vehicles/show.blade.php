<x-layout>
    <div class="p-4 flex justify-center">
        <h1 class="text-5xl">Jármű adatai</h1>
    </div>
    <div class="p-4">
        <div class="flex mb-4">
            <img src="{{ asset('storage/' . $vehicle->image) }}" alt="" style="width: 500px" class="rounded-2xl">
            <div class="ml-4">
                <div>
                    <p class="font-bold my-2">{{ $vehicle->license_plate }}</p>
                    <p class="font-bold my-2">{{ $vehicle->brand }}</p>
                    <p class="font-bold my-2">{{ $vehicle->model }}</p>
                    <p class="font-bold my-2">{{ $vehicle->production_year }}</p>
                </div>
                @if (Auth::user()->is_admin)
                    <form method="GET" action="{{ route('vehicles.edit', ['vehicle' => $vehicle]) }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 rounded-lg">Szerkesztés</button>
                    </form>
                @endif
            </div>
        </div>
        <hr>
        <div class="mt-4">
            <p class="font-bold text-lg">Káresemények</p>
            @foreach ($damage_events as $event)
                <div class="flex p-4 my-4 bg-red-500 rounded-2xl">
                    <form method="GET" action="{{ route('damage-events.show', ['damage_event' => $event]) }}"
                        class="flex-auto">
                        @csrf
                        <button type="submit" class="w-full">
                            <div class="flex items-center">
                                <p class="m-2 text-white font-bold">{{ $event->location }}</p>
                                <p class="m-2 text-white font-bold">{{ $event->date }}</p>
                            </div>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
