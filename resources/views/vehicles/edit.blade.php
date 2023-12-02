<x-layout>
    <h1>Jármű szerkesztés</h1>
    <div>
        <form method="POST" action="{{ route('vehicles.update', ['vehicle' => $vehicle]) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="license_plate">Rendszám</label>
                <input type="text"
                id="license_plate"
                name="license_plate"
                value="{{ old('license_plate', $vehicle -> license_plate) }}"
                disabled>
            </div>
            <div>
                <label for="brand">Márka</label>
                <input type="text"
                id="brand"
                name="brand"
                value="{{ old('brand', $vehicle -> brand) }}"
                >
                @error('brand')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="model">Típus</label>
                <input type="text"
                id="model"
                name="model"
                value="{{ old('model', $vehicle -> model) }}"
                >
                @error('model')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="production_year">Gyártási év</label>
                <input type="number"
                id="production_year"
                name="production_year"
                value="{{ old('production_year', $vehicle -> production_year) }}"
                >
                @error('production_year')
                    <p>{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="image">Kép</label>
                <input type="file"
                id="image"
                name="image"
                >
        
                @error('image')
                    <p>{{$message}}</p>
                @enderror
        
                <img src="{{ asset('storage/'.$vehicle -> image) }}" alt="">
            </div>
            <button type="submit">Frissítés</button>
        </form>
    </div>
</x-layout>