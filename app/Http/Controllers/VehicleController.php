<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        return view('vehicles.index', [
            'vehicles' => Vehicle::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        return view('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        if($request -> has('license_plate')) {
            $request['license_plate'] = strtoupper($request['license_plate']);
        }

        $validated = $request -> validate([
            'license_plate' => [
                'required',
                'string',
                'unique:vehicles',
                'regex:/^[A-Z]{3}-?[0-9]{3}$/'
            ],
            'brand' => 'required|string',
            'model' => 'required|string',
            'production_year' => 'required|integer|lte:'.now()->year,
            'image' => 'required|image'
        ]);

        $validated['image'] = $request -> file('image') -> store('images', 'public');

        Vehicle::create($validated);

        return redirect() -> route('vehicles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return view('vehicles.show', [
            'vehicle' => $vehicle,
            'damage_events' => $vehicle -> damageEvents() -> orderBy('date', 'desc') -> get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        return view('vehicles.edit', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        if($request -> has('license_plate')) {
            $request['license_plate'] = strtoupper($request['license_plate']);
        }

        $validated = $request -> validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'production_year' => 'required|integer|lte:'.now()->year
        ]);

        if($request -> has('image')) {
            $request -> validate(['image' => 'image']);
            Storage::delete($vehicle -> image);
            $validated['image'] = $request -> file('image') -> store('public/images');
        }

        $vehicle -> update($validated);

        return redirect() -> route('vehicles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        // Not needed
    }
}
