<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Passenger;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function filtered(Request $request){

        $departureAirport= Airport::where('name', $request->input('departure-airport'))->firstOrFail();
        $arrivalAirport=Airport::where('name', $request->input('arrival-airport'))->firstOrFail();
        $departureDate=date($request->input('departure-date'));

        if($departureAirport!=$arrivalAirport){

            $flights=Flight::with(['departureAirport', 'arrivalAirport', 'airplane:id,manufacturer,model,seating_capacity'])
                             ->withCount('passengers')
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

    public function getFlight(String $id){

        $flight=Flight::with(['airplane:id,manufacturer,model,seating_capacity'])->find($id);

        return response()->json(['flight'=>$flight],200);
    }


    public function registerPassengers(Request $request, String $id){

        $data=$request->all();

        $flight=Flight::find($id);
        
        foreach($data as $ticket){

            $passenger=Passenger::create([
                'name'=>$ticket['firstName'],
                'lastname'=>$ticket['surname'],
                'date_of_birth'=>$ticket['dateOfBirth'],
                'tax_code'=>$ticket['taxCode']
            ]);

            $flight->passengers()->attach($passenger['id']);
        }

        return response()->json([
            'passenger'=> 'ok',
            'data'=>$data,
            'id'=>$id,
            'flight'=>$flight,
        ],200);

    }
}
