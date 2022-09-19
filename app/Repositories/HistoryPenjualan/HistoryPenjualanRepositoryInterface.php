<?php

namespace App\Repositories\HistoryPenjualan;

interface HistoryPenjualanRepositoryInterface
{
    public function getHistoryByKendaraan(String $kendaraanId);
    public function createHistoryPenjualan(String $kendaraanId, int $qty, int $totalHarga, int $totalPembayaran);
}