<div class="bg-red-500 p-4">
    <form method="POST" action="{{ route('search-histories.store') }}"
    class="mb-4">
        @csrf
        <div class="flex divide-x-2">
            <input type="text" name="license_plate" value="{{ old('license_plate') }}"
            class="flex-auto rounded-l-xl border-none">
            <button type="submit" class="bg-white rounded-r-xl px-3">Keresés</button>
        </div>
        @error('license_plate')
            <p class="text-white">{{$message}}</p>
        @enderror
    </form>
    <form method="GET" action="{{ route('search-histories.index') }}"
    class="">
        @csrf
        <button type="submit" class="bg-white text-red-500 px-3 py-2 rounded-lg">Keresési előzmények</button>
    </form>
</div>