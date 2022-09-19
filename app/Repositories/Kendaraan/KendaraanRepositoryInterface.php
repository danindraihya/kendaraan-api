<?php

namespace App\Repositories\Kendaraan;

interface KendaraanRepositoryInterface
{
    public function save(Array $data);
    public function updateDataKendaraan(Array $data);
    public function getAll();
    public function getDataByMerek(String $merek);
}