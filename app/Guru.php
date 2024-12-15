<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'kode_guru';
    protected $guarded = [];
    public $incrementing = false;
}
