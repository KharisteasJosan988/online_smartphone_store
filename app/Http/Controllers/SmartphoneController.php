<?php

namespace App\Http\Controllers;

use App\Services\PhoneSpecsService;
use App\Services\SmartphoneService;
use Illuminate\Http\Request;

class SmartphoneController extends Controller
{
    protected $phoneService;

    public function __construct(SmartphoneService $phoneService)
    {
        $this->phoneService = $phoneService;
    }

    public function index()
    {
        $latestPhones = $this->phoneService->getLatestPhones();
        return view('phones.index', compact('latestPhones'));
    }

    public function brands()
    {
        $brands = $this->phoneService->getAllBrands();
        return view('phones.brands', compact('brands'));
    }

    public function brandPhones($brandSlug)
    {
        $phones = $this->phoneService->getPhonesByBrand($brandSlug);
        return view('phones.brand-phones', compact('phones'));
    }

    public function show($slug)
    {
        $phone = $this->phoneService->getPhoneDetails($slug);
        return view('phones.show', compact('phone'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = $this->phoneService->searchPhones($query);
        return view('phones.search', compact('results', 'query'));
    }
}
