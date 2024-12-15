<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailpresensisiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi_siswa_detail', function (Blueprint $table) {
            $table->bigInteger('id_presensi')->unsigned();
            $table->char('no_pendaftaran', 13);
            $table->char('status', 1);
            $table->foreign('id_presensi')->references('id')->on('presensi_siswa')->cascadeOnDelete();
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
        Schema::dropIfExists('detailpresensisiswas');
    }
}
