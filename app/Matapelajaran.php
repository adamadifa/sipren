<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matapelajaran extends Model
{
    protected $table = 'matapelajaran';
    protected $primaryKey = 'kode_matpel';
    public $incrementing = false;
    protected $guarded = [];
}
