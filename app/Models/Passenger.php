<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'date_of_birth',
        'tax_code'
    ];

    public function flights(){

        return $this->belongsToMany(Flight::class);
    }
}
