<?php

namespace App\Repositories\Kendaraan;

interface KendaraanRepositoryInterface
{
    public function tambahKendaraan(Array $data);
    public function updateKendaraan(Array $data);
    public function hapusKendaraan(Array $data);
}