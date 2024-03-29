<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranSatdn extends Model
{
    use HasFactory;

    protected $table = 'tran_satdn';

    protected $fillable = [
        'user_id',
        'pemegang_izin_id',
        'invoice',
        'no_ktp_pemohon',
        'no_permohonan_angkut',
        'tgl_permohonan_angkut',
        'no_satdn_asal',
        'tgl_satdn_asal',
        'file_permohonan',
        'nama_penerima',
        'telepon_penerima',
        'fax_penerima',
        'alamat_lengkap_penerima',
        'alat_angkut',
        'dari',
        'ke',
        'jenis_tsl',
        'satuan',
        'jumlah_kirim',
        'posisi',
        'status',
        'status_ket',
        'admin_teknis',
        'date_verified_teknis',
        'verifikator_teknis',
        'ket_teknis',
        'no_bap',
        'tgl_bap',
        'file_bap',
        'no_spt',
        'tgl_spt',
        'file_spt',
        'no_satdn',
        'tgl_dikeluarkan',
        'dikeluarkan_di',
        'tgl_satdn_mulai',
        'tgl_satdn_habis',
        'pj_ttd',
        'pj_nip',
        'pj_jabatan'
    ];

    public function pemegangIzin()
    {
        return $this->hasOne(PemegangIzin::class, 'id', 'pemegang_izin_id');
    }
    public function adminTeknis()
    {
        return $this->hasOne(AdminUser::class, 'id', 'admin_teknis');
    }

    public function tranSatdnLampiran()
    {
        return $this->hasMany(TranSatdnLampiran::class);
    }
}
