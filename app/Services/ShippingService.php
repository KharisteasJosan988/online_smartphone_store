<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ShippingService
{
    public function calculateShipping($courier, $weight)
    {
        if ($weight > 30000) {
            return null;
        }

        $response = Http::get('https://api.rajaongkir.com/starter/cost', [
            'origin' => '135', // Misalnya Gunung Kidul
            'destination' => '419', // Misalnya Sleman
            'weight' => $weight,
            'courier' => $courier,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'] ?? null;
        } else {
            // Error handling jika request gagal
            return null;
        }
    }
}
