<?php

declare(strict_types=1);

namespace App\Repositories\Kendaraan;
use App\Models\Kendaraan;

class MotorRepository implements KendaraanRepositoryInterface
{
    private Kendaraan $motor;

    public function __construct(Kendaraan $kendaraan)
    {
        $this->motor = $kendaraan;
    }

    public function save(Array $data)
    {

        try {
                
            $motor = new $this->motor();

            $stok = (isset($data['stok'])) ? $data['stok'] : 0;

            $motor->merek = $data['merek'];
            $motor->tahun_keluaran = $data['tahun_keluaran'];
            $motor->warna = $data['warna'];
            $motor->harga = $data['harga'];
            $motor->jenis = 'Motor';
            $motor->mesin = $data['mesin'];
            $motor->tipe_suspensi = $data['tipe_suspensi'];
            $motor->tipe_transmisi = $data['tipe_transmisi'];
            $motor->stok = $stok;

            $motor->save();

            return $motor;

        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
            
        }
    }

    public function updateDataKendaraan(Array $data)
    {
        try {
            $motor = $this->motor::where('_id', $data['id']);
        
            $motor->update($data, ['upsert' => true]);

            return $motor;
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }

        
    }

    public function getAll()
    {
        try {
            $listDataMotor = $this->motor::where('jenis', 'Motor')->get();

            return $listDataMotor;
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }

    }

    public function getDataByMerek(String $merek)
    {
        try {
            $dataMotor = $this->motor::where('merek', $merek)->where('jenis', 'Motor')->get();
    
            return $dataMotor;
        } catch (\Exception $error) {
            throw new \Exception($error->getMessage(), 500);
        }
    }


}