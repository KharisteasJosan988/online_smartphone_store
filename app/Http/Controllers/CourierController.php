<?php

namespace App\Http\Controllers;

use App\Models\Courier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::all();
        return view('backend.couriers.index', compact('couriers'));
    }

    public function update(Request $request, Courier $courier)
    {
        $courier->is_active = $request->is_active;
        $courier->save();

        return redirect()->back()->with('success', 'Courier updated successfully');
    }

    public function fetchCouriersFromAPI()
    {
        $response = Http::baseUrl(env('RAJAONGKIR_BASEURL'))
            ->withHeader('key', env('RAJAONGKIR_KEY'))
            ->get('city')
            ->object();

        // Cek apakah respons memiliki 'rajaongkir' dan 'results'
        if (!isset($response->rajaongkir) || !isset($response->rajaongkir->results)) {
            return redirect()->back()->with('error', 'Gagal mengambil data kurir dari API');
        }

        foreach ($response->rajaongkir->results as $courier) {
            Courier::updateOrCreate(
                ['code' => $courier->code],
                ['name' => $courier->name]
            );
        }

        return redirect()->back()->with('success', 'Couriers synced successfully');
    }
}
