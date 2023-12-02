<x-layout>
    <h1>Új káresemény</h1>
    <div>
        <form method="POST" action="{{ route('damage-events.store') }}">
            @csrf
            <div>
                <label for="location">Helyszín</label>
                <input type="text"
                id="location"
                name="location"
                value="{{ old('location') }}">
                @error('location')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="date">Időpont</label>
                <input type="text"
                id="date"
                name="date"
                value="{{ old('date') }}">
                @error('date')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="description">Leírás</label>
                <input type="text"
                id="description"
                name="description"
                value="{{ old('description') }}">
            </div>
            <div>
                @foreach ($vehicles as $vehicle)
                <div>
                    <input type="checkbox"
                    id="{{'vehicle'.$vehicle -> id}}"
                    name="vehicles[]"
                    value="{{$vehicle -> id}}"
                    @checked( in_array($vehicle -> id, old('vehicles', [])) )>
                    <label for="{{'vehicle'.$vehicle -> id}}">{{$vehicle -> license_plate}} | {{$vehicle -> production_year}}</label>
                </div>
                @endforeach
                @error('vehicles')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <button type="submit">Hozzáadás</button>
        </form>
    </div>
</x-layout>