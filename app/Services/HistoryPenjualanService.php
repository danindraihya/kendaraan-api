<?php

namespace App\Services;
use App\Repositories\HistoryPenjualan\HistoryPenjualanRepository;
use App\Repositories\Kendaraan\MotorRepository;
use App\Repositories\Kendaraan\MobilRepository;

class HistoryPenjualanService
{
    protected HistoryPenjualanRepository $historyPenjualanRepository;
    protected MobilRepository $mobilRepository;
    protected MotorRepository $motorRepository;

    public function __construct(HistoryPenjualanRepository $historyPenjualanRepository, MobilRepository $mobilRepository, MotorRepository $motorRepository)
    {
        $this->historyPenjualanRepository = $historyPenjualanRepository;
        $this->mobilRepository = $mobilRepository;
        $this->motorRepository = $motorRepository;
    }

    public function getHistoryPenjualanByMerek(Array $data)
    {
        try {

            $validator = Validator::make($data, [
                'merek' => 'required|string'
            ]);
    
            if($validator->fails()){
                throw new \Exception($validator->errors()->first(), 400);
            }
            
            $dataKendaraan = $this->motorRepository->getDataByMerek($data['merek']);

            if(count($dataKendaraan) < 1) {
                throw new \Exception("Data not found", 400);
            }

            $listDataHistoryPenjualan = $this->historyPenjualanRepository->getHistoryByKendaraan($dataKendaraan[0]['_id']);

            return $listDataHistoryPenjualan->toArray();
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
    }
}