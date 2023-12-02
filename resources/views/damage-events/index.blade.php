<x-layout>
    <div class="p-4 flex justify-center">
        <h1 class="text-5xl">Káresemények</h1>
    </div>
    <div>
        @foreach ($damage_events as $event)
            <div class="flex items-center p-4 m-4 bg-red-500 rounded-2xl">
                <form method="GET" action="{{ route('damage-events.show', ['damage_event' => $event]) }}"
                    class="flex-auto border-r-2">
                    @csrf
                    <button type="submit" class="w-full">
                        <div class="flex items-center">
                            <p class="m-2 text-white font-bold">{{$event -> location}}</p>
                            <p class="m-2 text-white font-bold">{{$event -> date}}</p>
                        </div>
                    </button>
                </form>
                <form method="GET" action="{{ route('damage-events.edit', ['damage_event' => $event]) }}">
                    @csrf
                    <button type="submit" class="px-4 text-white border-r-2">Szerkesztés</button>
                </form>
                <form method="POST" action="{{ route('damage-events.destroy', ['damage_event' => $event]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="pl-4 pr-2 text-white">
                        Törlés
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</x-layout>