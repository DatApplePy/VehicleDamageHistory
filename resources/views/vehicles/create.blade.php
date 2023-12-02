<x-layout>
    <h1>Új jármű</h1>
    <div>
        <form method="POST" action="{{ route('vehicles.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="license_plate">Rendszám</label>
                <input type="text"
                id="license_plate"
                name="license_plate"
                value="{{ old('license_plate') }}">
                @error('license_plate')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="brand">Márka</label>
                <input type="text"
                id="brand"
                name="brand"
                value="{{ old('brand') }}">
                @error('brand')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="model">Típus</label>
                <input type="text"
                id="model"
                name="model"
                value="{{ old('model') }}">
                @error('model')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="production_year">Gyártási év</label>
                <input type="number"
                id="production_year"
                name="production_year"
                value="{{ old('production_year') }}">
                @error('production_year')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="image">Kép</label>
                <input type="file"
                id="image"
                name="image">
                @error('image')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <button type="submit">Hozzáadás</button>
        </form>
    </div>
</x-layout>