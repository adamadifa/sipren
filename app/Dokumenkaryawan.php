<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumenkaryawan extends Model
{
    protected $table = 'dokumen_karyawan';
    protected $primaryKey = 'npp';
    protected $guarded = [];
}
