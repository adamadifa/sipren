<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwalpelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';
    protected $primaryKey = 'kode_jadwal';
    public $incrementing = false;
    protected $guarded = [];
}
