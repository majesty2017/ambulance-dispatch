<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AmbulanceInfo extends Model
{
    use HasFactory, SoftDeletes;

    public function driver()
    {
        return $this->belongsTo(DriverInfo::class);
    }
}
