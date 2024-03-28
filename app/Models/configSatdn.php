<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configSatdn extends Model
{
    use HasFactory;

    protected $table = 'config_satdn';

    protected $fillable = [
        'id',
        'format_surat',
        'awal_nomor',
        'akhir_nomor',

    ];
}
