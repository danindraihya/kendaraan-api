<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HistoryPenjualanService;

class HistoryPenjualanController extends Controller
{
    protected HistoryPenjualanService $historyPenjualanService;

    public function __construct(HistoryPenjualanService $historyPenjualanService)
    {
        $this->historyPenjualanService = $historyPenjualanService;
    }

    public function getLaporanPenjualanPerKendaraan(Request $request)
    {
        $data = $request->only([
            'merek'
        ]);

        $listDataLaporan = $this->historyPenjualanService->getHistoryPenjualanByMerek($data);

        dd($listDataLaporan);
    }
}
