<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Electionsinformation;

class InformationController extends Controller
{
    public function getcityval(Request $request)
    {
        $data = $request->all();
        $getCityVal = Electionsinformation::select(\DB::raw("DISTINCT(city_name)"))->where('state_name',isset($data['getValueOption'])?$data['getValueOption']:null)->get();
        $getCityVal = $getCityVal->toArray();
        return response()->json([
            'data' => $getCityVal,
        ]);
    }
    public function getparroquiaval(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $getCityVal = Electionsinformation::select(\DB::raw("DISTINCT(parroquia_name)"))->where(['state_name'=>isset($data['getValueState'])?$data['getValueState']:null,
            'city_name'=>isset($data['getValuecity'])?$data['getValuecity']:null
            ]
            )->get();
        $getCityVal = $getCityVal->toArray();
        return response()->json([
            'data' => $getCityVal,
        ]);
    }
    public function getZonaValue(Request $request)
    {
        $data = $request->all();
        $getZonaVal = Electionsinformation::select(\DB::raw("DISTINCT(zone_name)"))->where([
            'state_name'=>isset($data['getValueState'])?$data['getValueState']:null,
            'city_name'=>isset($data['getValuecity'])?$data['getValuecity']:null,
            'parroquia_name'=>isset($data['getValueparroquia'])?$data['getValueparroquia']:null
            ]
            )->get();
        $getZonaVal = $getZonaVal->toArray();
        return response()->json([
            'data' => $getZonaVal,
        ]);
    }
    public function getJuntaValue(Request $request)
    {
        $data = $request->all();
        $getJuntaVal = Electionsinformation::select(\DB::raw("DISTINCT male_voters,female_voters"))->where([
            'state_name'=>isset($data['getValueState'])?$data['getValueState']:null,
            'city_name'=>isset($data['getValueCanton'])?$data['getValueCanton']:null,
            'parroquia_name'=>isset($data['getValueparroquia'])?$data['getValueparroquia']:null,
            'zone_name'=>isset($data['getValuezona'])?$data['getValuezona']:null,
            'Circunscripcion'=>isset($data['getValuecircun'])?$data['getValuecircun']:null
            ]
            )->get();
        $getJuntaVal = $getJuntaVal->toArray();
        // dd($getJuntaVal);
        return response()->json([
            'data' => $getJuntaVal,
        ]);
    }
}
