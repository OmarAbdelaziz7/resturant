<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::with('user')->paginate(10);
        return view('admin.addresses', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.addresses.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'label' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'is_default' => 'boolean',
        ]);

        $validated['is_default'] = $request->has('is_default');

        Address::create($validated);

        return redirect()->route('admin.addresses.index')->with('success', 'Address created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return view('admin.addresses.show', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        $users = User::all();
        return view('admin.addresses.edit', compact('address', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'label' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'is_default' => 'boolean',
        ]);

        $validated['is_default'] = $request->has('is_default');

        $address->update($validated);

        return redirect()->route('admin.addresses.index')->with('success', 'Address updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        $address->delete();
        return redirect()->route('admin.addresses.index')->with('success', 'Address deleted successfully.');
    }
}
