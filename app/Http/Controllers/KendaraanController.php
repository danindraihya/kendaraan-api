<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Services\Kendaraan\KendaraanService;

class KendaraanController extends Controller
{

    protected KendaraanService $kendaraanservice;

    public function __construct(KendaraanService $kendaraanService)
    {
        $this->kendaraanService = $kendaraanService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "ok";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            
            // $kendaraan = new Kendaraan();

            // $kendaraan->tahun_keluaran = 2022;
            // $kendaraan->warna = 'hijau';
            // $kendaraan->harga = 20000.01;
            // $kendaraan->jenis = 'Mobil';
            // $kendaraan->mesin = 'V Engine';
            // $kendaraan->kapasitas_penumpang = 4;
            // $kendaraan->tipe = 'GG';
            // $kendaraan->tipe_suspensi = 'asd';
            // $kendaraan->tipe_transmisi = 'asd';

            // $kendaraan->save();

            // dd($kendaraan);

            dd($this->kendaraanService);

            $result = $this->kendaraanService->saveKendaraanData(['id' => 1]);


        } catch (\Throwable $th) {

            dd($th);

            return 'not ok';

            //throw $th;
        }

        return 'ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show(Kendaraan $kendaraan)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan)
    {
        //
    }
}
