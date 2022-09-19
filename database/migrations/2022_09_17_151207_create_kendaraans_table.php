<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->string('merek');
            $table->integer('tahun_keluaran');
            $table->string('warna');
            $table->double('harga', 200, 2);
            $table->string('jenis');
            $table->string('mesin');
            $table->integer('kapasitas_penumpang');
            $table->string('tipe');
            $table->string('tipe_suspensi');
            $table->string('tipe_transmisi');
            $table->integer('stok')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kendaraans');
    }
}
