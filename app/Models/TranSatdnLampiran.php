<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranSatdnLampiran extends Model
{
    use HasFactory;

    protected $table = 'tran_satdn_lampiran';

    protected $fillable = [
        'tran_satdn_id',
        'nama_indonesia',
        'nama_latin',
        'jumlah',
        'satuan',
        'keterangan'

    ];

}
