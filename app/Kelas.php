<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'kode_kelas';
    protected $guarded = [];
    public $incrementing = false;
}
