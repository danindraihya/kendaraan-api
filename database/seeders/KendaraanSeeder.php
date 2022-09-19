<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kendaraan;
use Illuminate\Support\Facades\DB;
use App\Models\HistoryPenjualan;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::collection('kendaraans')->delete();

        DB::collection('history_penjualans')->delete();
        // create data mobil

        $newDataMobil = new Kendaraan();
        $newDataMobil->merek = 'Toyota';
        $newDataMobil->jenis = 'Mobil';
        $newDataMobil->tahun_keluaran = 2020;
        $newDataMobil->warna = 'Hijau';
        $newDataMobil->harga = 20000;
        $newDataMobil->mesin = 'Diesel';
        $newDataMobil->kapasitas_penumpang = 4;
        $newDataMobil->tipe = 'Sedan';
        $newDataMobil->stok = 100;

        $newDataMobil->save();

        // create data motor
        $newDataMotor = new Kendaraan();
        $newDataMotor->merek = 'Ducati';
        $newDataMotor->jenis = 'Motor';
        $newDataMotor->tahun_keluaran = 2021;
        $newDataMotor->warna = 'Hitam';
        $newDataMotor->harga = 10000;
        $newDataMotor->mesin = '1 Silinder';
        $newDataMotor->tipe_suspensi = 'Pararel Fork';
        $newDataMotor->tipe_transmisi = 'Matic';
        $newDataMotor->stok = 100;

        $newDataMotor->save();

        // create history penjualan
        $historyPenjualan = new HistoryPenjualan();
        $historyPenjualan->kendaraan_id = $newDataMotor->_id;
        $historyPenjualan->qty = 1;
        $historyPenjualan->total_pembayaran = $newDataMotor->harga + 1000;
        $historyPenjualan->total_harga = $newDataMotor->harga;
        $historyPenjualan->total_kembalian = ($historyPenjualan->total_pembayaran - $historyPenjualan->total_harga);
        
        $historyPenjualan->save();

    }
}
