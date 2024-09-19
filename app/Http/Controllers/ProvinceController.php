<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProvinceController extends Controller
{
    public function list()
    {
        $response = Http::baseUrl(env('RAJAONGKIR_BASEURL'))
            ->withHeader('key', env('RAJAONGKIR_KEY'))
            ->get('province')
            ->object();
        // dd($response);
        return view('province.list', [
            'response' => $response
        ]);
    }

    public function cekOngkir()
    {
        $responseCity = Http::baseUrl(env('RAJAONGKIR_BASEURL'))
            ->withHeader('key', env('RAJAONGKIR_KEY'))
            ->get('city')
            ->object();
        return view('province.cek_ongkir', [
            'cities' => $responseCity->rajaongkir->results,
        ]);
    }

    public function cekOngkirProses(Request $request)
    {
        $idKotaAsal = $request->id_kota_asal;
        $idKotaTujuan = $request->id_kota_tujuan;
        $berat = $request->berat;
        $kurir = $request->kurir;
        $body = [   
            'origin' => (string)$idKotaAsal,
            'destination' => (string)$idKotaTujuan,
            'weight' => (int)$berat,
            'courier' => (string)$kurir,
        ];
        $response = Http::baseUrl(env('RAJAONGKIR_BASEURL'))
            ->withHeader('key', env('RAJAONGKIR_KEY'))
            ->post('cost', $body)->object();
        // dd($response);
        return view('province.detail-ongkir', [
            'data' => $response->rajaongkir
        ]);
    }
}
