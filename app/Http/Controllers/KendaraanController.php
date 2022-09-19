<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Services\KendaraanService;
use App\Traits\ResponseAPI;

class KendaraanController extends Controller
{
    use ResponseAPI;

    protected KendaraanService $kendaraanService;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
    }

    public function tambahDataMotor(Request $request)
    {

        try {

            $data = $request->only([
                'merek',
                'tahun_keluaran',
                'warna',
                'harga',
                'mesin',
                'tipe_suspensi',
                'tipe_transmisi'
            ]);
            

            $result = $this->kendaraanService->saveDataMotor($data);

            return $this->success("Berhasil menambahkan data motor", []);


        } catch (\Exception $error) {
            return $this->error($error->getMessage(), $error->getCode());

        }

    }

    public function tambahDataMobil(Request $request)
    {

        try {

            $data = $request->only([
                'merek',
                'tahun_keluaran',
                'warna',
                'harga',
                'mesin',
                'kapasitas_penumpang',
                'tipe',
            ]);
            

            $result = $this->kendaraanService->saveDataMobil($data);

            return $this->success("Berhasil menambahkan data motor", []);


        } catch (\Exception $error) {
            return $this->error($error->getMessage(), $error->getCode());
        }
    }

    public function updateDataMotor(Request $request)
    {
        try {
            $data = $request->only([
                'id',
                'tahun_keluaran',
                'warna',
                'harga',
                'mesin',
                'tipe_suspensi',
                'tipe_transmisi',
                'stok'
            ]);

    
            $result = $this->kendaraanService->updateDataMotor($data);

            if($result) {
                return $this->success('Berhasil update data motor', []);
            } else {
                return $this->error('Gagal update data motor', 400);
            }

        } catch (\Exception $error) {
            return $this->error($error->getMessage(), $error->getCode());
        }
        
    }

    public function updateDataMobil(Request $request)
    {
        try {

            $data = $request->only([
                'id',
                'tahun_keluaran',
                'warna',
                'harga',
                'mesin',
                'tipe_suspensi',
                'tipe_transmisi',
                'stok'
            ]);
    
            $result = $this->kendaraanService->updateDataMobil($data);
    
            return $this->success('Berhasil update data mobil', []);


        } catch (\Exception $error) {
            return $this->error($error->getMessage(), $error->getCode());
        }

        
    }

    public function lihatStokAllKendaraan(Request $request)
    {

        try {
           
            $result = $this->kendaraanService->getAllStokKendaraan();

            return $this->success("Sukses", $result);

        } catch (\Exception $error) {
            return $this->error($error->getMessage(), $error->getCode());
        }

    }

    public function lihatStokKendaraanByMerek(Request $request)
    {
        try {

            $data = $request->only([
                'merek'
            ]);

            $result = $this->kendaraanService->getKendaraanByMerek($data);
            
            return $this->success("Success", $result);
        } catch (\Exception $error) {
            return $this->error($error->getMessage(), $error->getCode());
        }
    }

    public function jualKendaraan(Request $request)
    {

        try {
            
            $data = $request->only([
                'merek',
                'qty',
                'total_pembayaran'
            ]);
    
            $result = $this->kendaraanService->jualKendaraan($data);
    
            if($result['status']) {
                return $this->success($result['message'], []);
            } else {
                return $this->error($result['message'], 400);
            }

        } catch (\Exception $error) {
            return $this->error($error->getMessage(), $error->getCode());
        }
        
    }

    
}
