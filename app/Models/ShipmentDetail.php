<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'fname',
        'lname',
        'phone',
        'email',
        'country',
        'address1',
        'address2',
        'city',
        'zip_code',
        'notes',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
