<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
  use HasFactory;

  public function departureAirport(){

    return $this->belongsTo(Airport::class, 'departure_airport_id', 'id');
    
  }

  public function arrivalAirport(){

    return $this->belongsTo(Airport::class, 'arrival_airport_id', 'id');
    
  }

  public function airplane(){

    return $this->belongsTo(Airplane::class);

  }


  public function passengers(){

    return $this->belongsToMany(Passenger::class);

  }

  public function getAvailableSeatsAttribute(){
    return $this->airplane->seating_capacity - $this->passengers->count();
  }

  protected $appends = [
    'available_seats'
  ];
}
