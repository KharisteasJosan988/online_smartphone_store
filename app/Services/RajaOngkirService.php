<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.rajaongkir.base_url');
        $this->apiKey = config('services.rajaongkir.key');
    }

    /**
     * HTTP client RajaOngkir.
     */
    protected function client()
    {
        return Http::withHeaders([
            'key' => $this->apiKey,
        ]);
    }

    /**
     * Mengambil daftar provinsi.
     */
    public function getProvinces()
    {
        return $this->client()
            ->get($this->baseUrl . '/destination/province')
            ->throw()
            ->json('data');
    }

    /**
     * Mengambil daftar kota/kabupaten berdasarkan provinsi.
     */
    public function getCities(int $provinceId)
    {
        return $this->client()
            ->get(
                $this->baseUrl . "/destination/city/{$provinceId}"
            )
            ->throw()
            ->json('data');
    }

    /**
     * Mengambil daftar kecamatan berdasarkan kota/kabupaten.
     */
    public function getDistricts(int $cityId)
    {
        return $this->client()
            ->get(
                $this->baseUrl . "/destination/district/{$cityId}"
            )
            ->throw()
            ->json('data');
    }

    /**
     * Menghitung ongkos kirim berdasarkan district.
     */
    public function calculateShipping(
        int $origin,
        int $destination,
        int $weight,
        string $courier
    ) {
        return $this->client()
            ->asForm()
            ->post(
                $this->baseUrl . '/calculate/district/domestic-cost',
                [
                    'origin' => $origin,
                    'destination' => $destination,
                    'weight' => $weight,
                    'courier' => $courier,
                    'price' => 'lowest',
                ]
            )
            ->throw()
            ->json('data');
    }
}
