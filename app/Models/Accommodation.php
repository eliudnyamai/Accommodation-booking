<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'standard_rack_rate',
        'available_units', 
    ];
    public function bookings()
{
    return $this->hasMany(Booking::class);
}
public function contracts()
{
    return $this->hasMany(Contract::class);
}
}
