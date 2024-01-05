<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function filtered(Request $request){

        $departureAirport= Airport::where('name', $request->input('departure-airport'))->firstOrFail();
        $arrivalAirport=Airport::where('name', $request->input('arrival-airport'))->firstOrFail();
        $departure_date=date($request->input('departure-date', now()));


        $flights=Flight::where('departure_airport_id', $departureAirport->id)
                         ->where('arrival_airport_id', $arrivalAirport->id)
                         ->where('departure_datetime', '>', $departure_date)
                         ->orderBy('departure_datetime', 'ASC')
                         ->get();
        return response()->json(['flights'=>$flights], 200);
    }
}
