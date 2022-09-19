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
            throw new \Exception($error->getMessage(), 500);
        }

    }

    public function createHistoryPenjualan(String $kendaraanId, int $qty)
    {
        try {

            $historyPenjualan = new $this->historyPenjualan();

            $historyPenjualan->kendaraan_id = $kendaraanId;
            $historyPenjualan->qty = $qty;
            $historyPenjualan->save();

            return $historyPenjualan->fresh();

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }

        

    }
}