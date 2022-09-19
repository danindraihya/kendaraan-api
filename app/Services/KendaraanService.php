<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Kendaraan\MobilRepository;
use App\Repositories\Kendaraan\MotorRepository;
use App\Repositories\HistoryPenjualan\HistoryPenjualanRepository;
use Illuminate\Support\Facades\Validator;

class KendaraanService
{
    protected MobilRepository $mobilRepository;
    protected MotorRepository $motorRepository;
    protected HistoryPenjualanRepository $historyPenjualanRepository;

    public function __construct(MobilRepository $mobilRepository, MotorRepository $motorRepository, HistoryPenjualanRepository $historyPenjualanRepository)
    {
        $this->mobilRepository = $mobilRepository;
        $this->motorRepository = $motorRepository;
        $this->historyPenjualanRepository = $historyPenjualanRepository;
    }

    public function getAllStokKendaraan()
    {

        try {

            // get stok motor
            $listDataMotor = $this->motorRepository->getAll();

            // get stok mobil
            $listDataMobil = $this->mobilRepository->getAll();
            
            $listDataKendaraanTemp = $listDataMotor->concat($listDataMobil);

            $listStokKendaraan = [];

            foreach($listDataKendaraanTemp as $dataKendaraanTemp) {
                array_push($listStokKendaraan, 
                [
                    "Merek" => $dataKendaraanTemp['merek'],
                    "Jenis" => $dataKendaraanTemp['jenis'],
                    "Stok" => $dataKendaraanTemp['stok']
                ]);
            }

            return $listStokKendaraan;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
        
    }

    public function getKendaraanByMerek(Array $data)
    {
        try {

            $validator = Validator::make($data, [
                'merek' => 'required|string'
            ]);
    
            if($validator->fails()){
                throw new \Exception($validator->errors()->first(), 400);
            }

            $dataMotor = $this->motorRepository->getDataByMerek($data['merek']);

            if(count($dataMotor) > 0) {

                return [
                    "Merek" => $dataMotor[0]['merek'],
                    "Jenis" => $dataMotor[0]['jenis'],
                    "Stok" => $dataMotor[0]['stok']
                ];
            }

            $dataMobil = $this->mobilRepository->getDataByMerek($data['merek']);

            if(count($dataMobil) > 0) {
                return [
                    "Merek" => $dataMobil[0]['merek'],
                    "Jenis" => $dataMobil[0]['jenis'],
                    "Stok" => $dataMobil[0]['stok']
                ];
            }

            return [];

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
    }

    public function jualKendaraan(Array $data)
    {
        try {

            $validator = Validator::make($data, [
                'merek' => 'required|string',
                'qty' => 'required|integer'
            ]);
    
            if($validator->fails()){
                throw new \Exception($validator->errors()->first(), 400);
            }
            
            $dataMotor = $this->motorRepository->getDataByMerek($data['merek']);

            if(count($dataMotor) > 0) {

                if($dataMotor[0]['stok'] < $data['qty']) {
                    return [
                        "status" => false,
                        "message" => "Stok kendaraan kurang dari quantity beli"
                    ];
                }
                
                $createHistoryPenjualan = $this->historyPenjualanRepository->createHistoryPenjualan($dataMotor[0]['_id'], $data['qty']);
                $updateStokKendaraan = $this->motorRepository->updateDataKendaraan($dataMotor[0]['_id'], ['stok' => ($dataMotor[0]['stok'] - $data['qty'])]);

                return [
                        "status" => true,
                        "message" => "Berhasil melakukan transaksi"
                    ];

            }

            $dataMobil = $this->mobilRepository->getDataByMerek($data['merek']);

            if(count($dataMobil) > 0) {

                if($dataMobil[0]['stok'] < $data['qty']) {
                    return [
                        "status" => false,
                        "message" => "Stok kendaraan kurang dari quantity beli"
                    ];
                }

                $createHistoryPenjualan = $this->historyPenjualanRepository->createHistoryPenjualan($dataMobil[0]['_id'], $data['qty']);
                $updateStokKendaraan = $this->mobilRepository->updateDataKendaraan($dataMobil[0]['_id'], ['stok' => ($dataMobil[0]['stok'] - $data['qty'])]);

                return [
                        "status" => true,
                        "message" => "Berhasil melakukan transaksi"
                    ];
            }

            return [
                "status" => false,
                "message" => "Data kendaraan tidak ditemukan"
            ];


        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
    }

    public function getAllMotor()
    {
        try {
            $result = $this->motorRepository->getAll();
            return $result;
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }

    }

    public function saveDataMotor(Array $data)
    {
        try {
            
            $validator = Validator::make($data, [
                'merek' => 'required|string|unique:kendaraans',
                'tahun_keluaran' => 'required|integer',
                'warna' => 'required|string',
                'harga' => 'required|string',
                'mesin' => 'required|string',
                'tipe_suspensi' => 'required|string',
                'tipe_transmisi' => 'required|string',
            ]);
    
            if($validator->fails()){
                throw new \Exception($validator->errors()->first(), 400);
            }
    
            $result = $this->motorRepository->save($data);
    
            return $result;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }

        
    }

    public function updateDataMotor(Array $data)
    {
        try {
            
            $validator = Validator::make($data, [
                'id' => 'required|string',
                'merek' => 'nullable|string',
                'tahun_keluaran' => 'nullable|integer',
                'warna' => 'nullable|string',
                'harga' => 'nullable|string',
                'mesin' => 'nullable|string',
                'tipe_suspensi' => 'nullable|string',
                'tipe_transmisi' => 'nullable|string',
            ]);
    
            if($validator->fails()){
                throw new \Exception($validator->errors()->first(), 400);
            }

            $result = $this->motorRepository->updateDataKendaraan($data);
    
            return $result;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }

    }

    public function updateDataMobil(Array $data)
    {
        
        try {
            
            $validator = Validator::make($data, [
                'id' => 'required|string',
                'merek' => 'nullable|string',
                'tahun_keluaran' => 'nullable|integer',
                'warna' => 'nullable|string',
                'harga' => 'nullable|string',
                'mesin' => 'nullable|string',
                'kapasitas_penumpang' => 'nullable|integer',
                'tipe' => 'nullable|string'
            ]);
    
            if($validator->fails()){
                throw new \Exception($validator->errors()->first(), 400);
            }
    
            $result = $this->mobilRepository->updateDataKendaraan($data);
    
            return $result;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }

    }

    public function getAllMobil()
    {

        try {
            $listDataMobil = $this->mobilRepository->getAll();
    
            return $listDataMobil;
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
    }

    public function saveDataMobil(Array $data)
    {
        try {
            
            $validator = Validator::make($data, [
                'merek' => 'required|string|unique:kendaraans',
                'tahun_keluaran' => 'required|integer',
                'warna' => 'required|string',
                'harga' => 'required|string',
                'mesin' => 'required|string',
                'kapasitas_penumpang' => 'required|integer',
                'tipe' => 'required|string'
            ]);
    
            if($validator->fails()){
                throw new \Exception($validator->errors()->first(), 400);
            }
    
            $result = $this->mobilRepository->save($data);
    
            return $result;

        } catch (\Exception $error) {
            return new \Exception($error->getMessage(), 500);
        }

        
    }
}