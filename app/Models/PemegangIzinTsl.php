<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemegangIzinTsl extends Model
{
    use HasFactory;

    protected $table = 'pemegang_izin_tsl';

    protected $fillable = [
        'pemegang_izin_id',
        'nama_indonesia',
        'nama_latin',
        'satuan'
    ];
}
