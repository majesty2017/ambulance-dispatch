<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmbulanceInfo extends Model
{
    use HasFactory;

    public function driver()
    {
        return $this->belongsTo(DriverInfo::class);
    }
}
