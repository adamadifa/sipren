<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{
    use Notifiable;
    protected $table = 'guru';
    protected $primaryKey = 'kode_guru';
    protected $guarded = [];
    public $incrementing = false;

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
