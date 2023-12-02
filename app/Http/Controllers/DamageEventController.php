<?php

namespace App\Http\Controllers;

use App\Models\DamageEvent;
use App\Models\Vehicle;
use Closure;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DamageEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        return view('damage-events.index', [
            'damage_events' => DamageEvent::all()
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

        return view('damage-events.create', [
            'vehicles' => Vehicle::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        $request -> validate([
            'vehicles' => 'required|array',
            'vehicles.*' => 'required|distinct|integer|exists:vehicles,id'
        ], [
            'vehicles.required' => 'At least 1 vehicle must be selected'
        ]);

        $validated = $request -> validate([
            'location' => 'required|string',
            'description' => 'string|nullable',
            'date' => [
                'required',
                'date-format:Y-m-d H:i:s',
                function (string $attribute, mixed $value, Closure $fail) use ($request){
                    $latest_year = Vehicle::find($request['vehicles']) -> pluck('production_year') -> max();
                    $event_date = new DateTime($value);
                    if ((int)($event_date -> format("Y")) < $latest_year) {
                        $fail("The date of the event must not be less, than the maximum of the production year of the selected vehicles.");
                    }
                }
            ]
        ]);

        $damage_event = DamageEvent::create($validated);
        $damage_event -> vehicles() -> sync($request['vehicles'] ?? []);

        return redirect() -> route('damage-events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(DamageEvent $damageEvent)
    {
        if (!Auth::user() -> is_premium) {
            abort(403, 'Unauthorized action');
        }

        return view('damage-events.show', [
            'damage_event' => $damageEvent
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DamageEvent $damageEvent)
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        return view('damage-events.edit', [
            'damage_event' => $damageEvent,
            'vehicles' => Vehicle::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DamageEvent $damageEvent)
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        $request -> validate([
            'vehicles' => 'required|array',
            'vehicles.*' => 'required|distinct|integer|exists:vehicles,id'
        ], [
            'vehicles.required' => 'At least 1 vehicle must be selected'
        ]);

        $validated = $request -> validate([
            'location' => 'required|string',
            'description' => 'string',
            'date' => [
                'required',
                'date-format:Y-m-d H:i:s',
                function (string $attribute, mixed $value, Closure $fail) use ($request){
                    $latest_year = Vehicle::find($request['vehicles']) -> pluck('production_year') -> max();
                    $event_date = new DateTime($value);
                    if ((int)($event_date -> format("Y")) < $latest_year) {
                        $fail("The date of the event must not be less, than the maximum of the production year of the selected vehicles.");
                    }
                }
            ]
        ]);

        $damageEvent -> update($validated);
        $damageEvent -> vehicles() -> sync($request['vehicles'] ?? []);

        return redirect() -> route('damage-events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DamageEvent $damageEvent)
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }
        
        $damageEvent -> delete();
        return redirect() -> route('damage-events.index');
    }
}
