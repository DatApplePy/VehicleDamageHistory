<?php

namespace App\Http\Controllers;

use App\Models\SearchHistory;
use App\Models\Vehicle;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search_histories = SearchHistory::where('user_id', Auth::user() -> id) -> orderBy('date', 'desc') -> get();
        return view('search-histories.index', [
            'search_histories' => $search_histories,
            'vehicles' => Vehicle::whereIn('license_plate', $search_histories -> pluck('license_plate')) -> get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Not needed
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request -> has('license_plate')) {
            $request['license_plate'] = strtoupper($request['license_plate']);
        }

        $validated = $request -> validate([
            'license_plate' => [
                'required',
                'string',
                'exists:vehicles',
                'regex:/^[A-Z]{3}-?[0-9]{3}$/'
            ]
        ]);

        $validated['user_id'] = Auth::user() -> id;

        $validated['date'] = now();

        SearchHistory::create($validated);
        $vehicle = Vehicle::where('license_plate', $validated['license_plate']) -> get()[0];

        return redirect() -> route('vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SearchHistory $searchHistory)
    {
        // Not needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SearchHistory $searchHistory)
    {
        // Not needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SearchHistory $searchHistory)
    {
        $validated['date'] = now();

        $searchHistory -> update($validated);
        $vehicle = Vehicle::where('license_plate', $searchHistory['license_plate']) -> get()[0];
        
        return redirect() -> route('vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SearchHistory $searchHistory)
    {
        $searchHistory -> delete();
        return redirect() -> route('search-histories.index');
    }
}
