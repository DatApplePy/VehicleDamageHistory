<x-layout>
    <div class="p-4 flex justify-center">
        <h1 class="text-5xl">Járművek</h1>
    </div>
    <div>
        @foreach ($vehicles as $vehicle)
            <div class="flex items-center p-4 m-4 bg-red-500 rounded-2xl">
                <form method="GET" action="{{ route('vehicles.show', ['vehicle' => $vehicle]) }}"
                    class="flex-auto border-r-2">
                    @csrf
                    <button type="submit" class="w-full">
                        <div class="flex items-center">
                            <img src="{{asset('storage/'.$vehicle -> image)}}" alt=""
                            class="w-24 m-2 border-2 rounded">
                            <p class="m-2 text-white font-bold">{{$vehicle -> license_plate}}</p>
                        </div>
                    </button>
                </form>
                <form method="GET" action="{{ route('vehicles.edit', ['vehicle' => $vehicle]) }}">
                    @csrf
                    <button type="submit" class="pl-4 pr-2 text-white">
                        Szerkesztés
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</x-layout>