<?php

namespace App\Services;
use App\Repositories\HistoryPenjualan\HistoryPenjualanRepository;
use App\Repositories\Kendaraan\MotorRepository;
use App\Repositories\Kendaraan\MobilRepository;
use Illuminate\Support\Facades\Validator;

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
            
            $dataMotor = $this->motorRepository->getDataByMerek($data['merek']);
            $dataMobil = $this->mobilRepository->getDataByMerek($data['merek']);

            if(count($dataMotor) < 1 && count($dataMobil) < 1) {
                throw new \Exception("Data not found", 400);
            }

            $dataKendaraan = $dataMotor;

            if(count($dataMotor) < 1) {
                $dataKendaraan = $dataMobil;
            }

            if(count($dataKendaraan) < 1) {
            } else {
                $dataKendaraan = $dataKendaraan[0];
            }

            $listDataHistoryPenjualan = $this->historyPenjualanRepository->getHistoryByKendaraan($dataKendaraan['_id']);

            $listLaporanPenjualan = [];

            foreach($listDataHistoryPenjualan as $dataHistoryPenjualan) {
                array_push($listLaporanPenjualan, [
                    'merek' => $data['merek'],
                    'jenis' => $dataKendaraan['jenis'],
                    'terjual' => $dataHistoryPenjualan['qty'],
                    'total_pembayaran' => $dataHistoryPenjualan['total_pembayaran'],
                    'total_harga' => $dataHistoryPenjualan['total_harga'],
                    'total_kembalian' => $dataHistoryPenjualan['total_kembalian'],
                    'tanggal_terjual' => date('d-m-Y', strtotime($dataHistoryPenjualan['created_at']))
                ]);
            }

            return $listLaporanPenjualan;
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), $error->getCode());
        }
    }
}