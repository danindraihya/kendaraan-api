<?php

namespace App\Repositories\HistoryPenjualan;

interface HistoryPenjualanRepositoryInterface
{
    public function getHistoryByKendaraan(String $kendaraanId);
}