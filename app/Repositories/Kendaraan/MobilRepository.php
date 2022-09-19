<?php

declare(strict_types=1);

namespace App\Repositories\Kendaraan;
use App\Models\Kendaraan;

class MobilRepository implements KendaraanRepositoryInterface
{
    private Kendaraan $mobil;

    public function __construct(Kendaraan $kendaraan)
    {
        $this->mobil = $kendaraan;
    }

    public function save(Array $data)
    {
        try {
            
            $mobil = new $this->mobil();

            $stok = (isset($data['stok'])) ? $data['stok'] : 0;

            $mobil->merek = $data['merek'];
            $mobil->tahun_keluaran = $data['tahun_keluaran'];
            $mobil->warna = $data['warna'];
            $mobil->harga = $data['harga'];
            $mobil->jenis = 'Mobil';
            $mobil->mesin = $data['mesin'];
            $mobil->kapasitas_penumpang = $data['kapasitas_penumpang'];
            $mobil->tipe = $data['tipe'];
            $mobil->stok = $stok;

            $mobil->save();

            return $mobil;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
    }

    public function updateDataKendaraan(Array $data)
    {
        try {
            
            $mobil = $this->mobil::where('_id', $data['id']);
            
            $mobil->update($data, ['upsert' => true]);

            return $mobil;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
    }

    public function getAll()
    {
        try {
            $listDataMobil = $this->mobil::where('jenis', 'Mobil')->get();
    
            return $listDataMobil;
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }

    }

    public function getDataByMerek(String $merek)
    {
        try {
            $dataMobil = $this->mobil::where('merek', $merek)->where('jenis', 'Mobil')->get();
    
            return $dataMobil;
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
    }

}