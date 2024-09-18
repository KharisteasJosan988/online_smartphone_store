<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmartphoneService
{
    protected $baseUrl = 'https://api-mobilespecs.azharimm.site';

    /**
     * Get latest phones
     */
    public function getLatestPhones()
    {
        $response = Http::get($this->baseUrl . '/latest');
        return $response->json();
    }

    /**
     * Get phones by brand
     */
    public function getPhonesByBrand($brandSlug)
    {
        $response = Http::get($this->baseUrl . '/brands/' . $brandSlug);
        return $response->json();
    }

    /**
     * Get all brands
     */
    public function getAllBrands()
    {
        $response = Http::get($this->baseUrl . '/brands');
        return $response->json();
    }

    /**
     * Get phone details
     */
    public function getPhoneDetails($slug)
    {
        $response = Http::get($this->baseUrl . '/v2/' . $slug);
        return $response->json();
    }

    /**
     * Search phones
     */
    public function searchPhones($query)
    {
        $response = Http::get($this->baseUrl . '/search', [
            'query' => $query
        ]);
        return $response->json();
    }
}
