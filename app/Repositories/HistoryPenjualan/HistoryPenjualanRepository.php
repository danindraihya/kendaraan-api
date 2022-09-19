<?php

namespace App\Repositories\HistoryPenjualan;
use App\Models\HistoryPenjualan;
use App\Repositories\HistoryPenjualan\HistoryPenjualanRepositoryInterface;

class HistoryPenjualanRepository implements HistoryPenjualanRepositoryInterface
{
    protected HistoryPenjualan $historyPenjualan;

    public function __construct(HistoryPenjualan $historyPenjualan)
    {
        $this->historyPenjualan = $historyPenjualan;
    }

    public function getHistoryByKendaraan(String $kendaraanId)
    {
        try {
            
            $listDataHistoryPenjualan = $this->historyPenjualan::where('kendaraan_id', $kendaraanId)->get();

            return $listDataHistoryPenjualan;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), $error->getCode());
        }

    }

    public function createHistoryPenjualan(String $kendaraanId, int $qty, int $totalHarga, int $totalPembayaran)
    {
        try {

            $historyPenjualan = new $this->historyPenjualan();

            $historyPenjualan->kendaraan_id = $kendaraanId;
            $historyPenjualan->qty = $qty;
            $historyPenjualan->total_harga = $totalHarga;
            $historyPenjualan->total_pembayaran = $totalPembayaran;
            $historyPenjualan->total_kembalian = ($totalPembayaran - $totalHarga);
            $historyPenjualan->save();

            return $historyPenjualan;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), $error->getCode());
        }

        

    }
}