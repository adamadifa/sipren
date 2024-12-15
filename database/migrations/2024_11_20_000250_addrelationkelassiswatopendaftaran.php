<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addrelationkelassiswatopendaftaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kelas_siswa', function (Blueprint $table) {
            $table->foreign('no_pendaftaran')->references('no_pendaftaran')->on('pendaftaran')->restrictOnDelete();
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
