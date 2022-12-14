<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use App\Models\HistoryPenjualan;

class Kendaraan extends Eloquent
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $guarded = ['id'];

    public function historyPenjualan()
    {
        return $this->hasMany(HistoryPenjualan::class);
    }
}
