<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\KendaraanRepository;

class KendaraanService
{
    private KendaraanRepository $kendaraanRepository;

    public function __construct(KendaraanRepository $kendaraanRepository)
    {
        $this->kendaraanRepository = $kendaraanRepository;
    }

    public function saveKendaraanData(Array $data)
    {
        $result = $this->kendaraanRepository->save($data);

        return $result;
    }
}