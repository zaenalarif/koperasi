<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['withdraw', 'menyetor', 'member_id', 'tabungan_id'];

    public function member()
    {
        return $this->belongsTo('App\Models\Member');
    }

    public function tabungan()
    {
        return $this->belongsTo('App\Models\Tabungan');
    }
}
