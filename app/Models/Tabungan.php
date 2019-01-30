<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $fillable = ['norekening','saldo', 'member_id'];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
