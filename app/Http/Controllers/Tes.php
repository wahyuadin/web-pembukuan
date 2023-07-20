<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;

class Tes extends Controller
{
    public function index () {
        $api = file_get_contents('http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        $api = json_decode($api, true);

        $provinces = Province::where('name', 'JAWA BARAT')->first();
        $regencies = Regency::where('name', 'LIKE', '%CIANJUR%')->first();
        $districts = District::where('name', 'LIKE', 'BANDUNG%')->get();
        $villages = Village::where('name', 'BOJONGHERANG')->first();

        dd($villages);


        // return view('tes',['api' => $api]);
    }
}
