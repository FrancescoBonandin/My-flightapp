<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;


class AirportController extends Controller
{

    public function index(){
        $airports=Airport::orderBy('name','asc')->pluck('name');

        return response()->json(['airports'=>$airports], 200);
    }

}
