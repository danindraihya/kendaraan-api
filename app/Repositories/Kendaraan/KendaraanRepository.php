<?php

declare(strict_types=1);

namespace App\Repositories\Kendaraan;
use App\Models\Kendaraan;

class KendaraanRepository
{
    private Kendaraan $kendaraan;

    public function __construct(Kendaraan $kendaraan)
    {
        $this->kendaraan = $kendaraan;
    }

    public function save(Array $data)
    {
        $kendaraan = new $this->kendaraan();

        $kendaraan->tahun_keluaran = 2022;
        $kendaraan->warna = 'hijau';
        $kendaraan->harga = 20000.01;
        $kendaraan->jenis = 'Mobil';
        $kendaraan->mesin = 'V Engine';
        $kendaraan->kapasitas_penumpang = 4;
        $kendaraan->tipe = 'GG';
        $kendaraan->tipe_suspensi = 'asd';
        $kendaraan->tipe_transmisi = 'asd';

        $kendaraan->save();

        return $kendaraan->fresh();
    }


}