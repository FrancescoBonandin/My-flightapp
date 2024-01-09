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
        $departureDate=date($request->input('departure-date'));

        if($departureAirport!=$arrivalAirport){

            $flights=Flight::with(['departureAirport', 'arrivalAirport'])
                             ->where('departure_airport_id', $departureAirport->id)
                             ->where('arrival_airport_id', $arrivalAirport->id)
                             ->where('departure_datetime', '>', $departureDate)
                             ->orderBy('departure_datetime', 'ASC')
                             ->get();
            return response()->json(['flights'=>$flights], 200);

        }

        else{
            // MAKE A CHOICE ON WHAT TO RESPOND IN CASE OF ERROR
        }

    }
}
