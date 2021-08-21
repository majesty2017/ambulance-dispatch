<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DispatchStatus extends Model
{
    use HasFactory;

    public function driver()
    {
        return $this->belongsTo(DriverInfo::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function request()
    {
        return $this->belongsTo(ERequest::class);
    }
}
