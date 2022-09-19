<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HistoryPenjualanService;
use App\Traits\ResponseApi;

class HistoryPenjualanController extends Controller
{
    use ResponseApi;

    protected HistoryPenjualanService $historyPenjualanService;

    public function __construct(HistoryPenjualanService $historyPenjualanService)
    {
        $this->historyPenjualanService = $historyPenjualanService;
    }

    public function getLaporanPenjualanPerKendaraan(Request $request)
    {
        try {

            $data = $request->only([
                'merek'
            ]);
    
            $listDataLaporan = $this->historyPenjualanService->getHistoryPenjualanByMerek($data);
    
            return $this->success('Success', $listDataLaporan);

        } catch (\Exception $error) {

            return $this->error($error->getMessage(), $error->getCode());
        }
        
    }

}
