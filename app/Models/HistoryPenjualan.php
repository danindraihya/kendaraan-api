<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use App\Models\Kendaraan;

class HistoryPenjualan extends Eloquent
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function kendaraan()
    {

        return $this->belongsTo(Kendaraan::class);
    }


}
