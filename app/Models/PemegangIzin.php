<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemegangIzin extends Model
{
    use HasFactory;

    protected $table = 'pemegang_izin';

    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'alamat_lengkap',
        'telepon',
        'fax',
        'jenis_tsl',
        'no_sk_oss',
        'tgl_sk_oss',
        'nama_pemohon',
        'tgl_habis_sk',
        'dokumen_izin',
        'active',
        'keterangan',
        'satuan',
        'kuota_sumber',
        'kuota',
        'kuota_digunakan',
        'kuota_sisa',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function tranSatdn()
    {
        return $this->hasMany(TranSatdn::class, 'id', 'pemegang_izin_id');
    }

    public function pemegangIzinTsl()
    {
        return $this->hasMany(PemegangIzinTsl::class);
    }
}


