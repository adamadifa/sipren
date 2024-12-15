<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addrelationkelassiswatopendaftarankelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas_siswa', function (Blueprint $table) {
            $table->foreign('kode_kelas')->references('kode_kelas')->on('kelas')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kelas_siswa', function (Blueprint $table) {
            //
        });
    }
}
