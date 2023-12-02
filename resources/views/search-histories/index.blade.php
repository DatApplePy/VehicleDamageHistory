@php
    function searchImage($vehicles, $search)
    {
        $vehicle = $vehicles->where('license_plate', $search->license_plate);
        return 'storage/' . $vehicle->first()->image;
    }
@endphp

<x-layout>
    <div class="p-4 flex justify-center">
        <h1 class="text-5xl">Keresési előzmények</h1>
    </div>
    <div>
        @foreach ($search_histories as $search)
            <div class="flex items-center p-4 m-4 bg-red-500 rounded-2xl">
                <form method="POST" action="{{ route('search-histories.update', ['search_history' => $search]) }}"
                    class="flex-auto border-r-2">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="w-full">
                        <div class="flex items-center">
                            <img src="{{ searchImage($vehicles, $search) }}" alt=""
                            class="w-24 m-2 border-2 rounded">
                            <p class="m-2 text-white font-bold">{{ $search->license_plate }}</p>
                            <p class="m-2 text-white font-bold">{{ $search->date }}</p>
                        </div>
                    </button>
                </form>
                <form method="POST" action="{{ route('search-histories.destroy', ['search_history' => $search]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="pl-4 pr-2 text-white">Törlés</button>
                </form>
            </div>
        @endforeach
    </div>
</x-layout>
