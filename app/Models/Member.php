<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['ktp','nama', 'alamat'];

    public function tabungan()
    {
        return $this->hasOne('App\Models\Tabungan');
    }   

    public function transaction()
    {
        return $this->hasMany('App\Models\Member');
    }
}
