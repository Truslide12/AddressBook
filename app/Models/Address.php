<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [ 'id', 'number', 'street', 'city', 'state', 'zip', 'type', 'contact_id' ];

    public function contacts()
    {
        return $this->belongsTo('App\Contact');
    }
}
