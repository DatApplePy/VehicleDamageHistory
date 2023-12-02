<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        return view('users.index', [
            'users' => User::all()
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
        // Not needed
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Not needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Not needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (!Auth::user() -> is_admin) {
            abort(403, 'Unauthorized action');
        }

        $validated = $request -> validate([
            'is_premium' => 'required|boolean'
        ]);

        $user -> update($validated);

        return redirect() -> route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Not needed
    }
}
