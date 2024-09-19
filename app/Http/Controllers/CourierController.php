<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::all();
        return view('couriers.index', compact('couriers'));
    }

    public function create()
    {
        return view('couriers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:couriers'
        ]);

        Courier::create($validated);
        return redirect()->route('couriers.index')->with('success', 'Courier created successfully.');
    }

    public function show(Courier $courier)
    {
        return view('couriers.show', compact('courier'));
    }

    public function edit(Courier $courier)
    {
        return view('couriers.edit', compact('courier'));
    }

    public function update(Request $request, Courier $courier)
    {
        $validated = $request->validate([
            'name' => 'required|unique:couriers,name,' . $courier->id
        ]);

        $courier->update($validated);
        return redirect()->route('couriers.index')->with('success', 'Courier updated successfully.');
    }

    public function destroy(Courier $courier)
    {
        $courier->delete();
        return redirect()->route('couriers.index')->with('success', 'Courier deleted successfully.');
    }
}
