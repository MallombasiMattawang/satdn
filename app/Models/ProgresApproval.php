<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class ProgresApproval extends Model
{
    use HasFactory, SoftDeletes;
    use DefaultDatetimeFormat;

    protected $fillable = [
        'progres_document_id',
        'approval_ka_seksi',
        'name_ka_seksi', 
        'note_ka_seksi',
        'approval_ka_bidang', 
        'name_ka_bidang', 
        'note_ka_bidang',
        'apporval_sekretaris', 
        'name_sekretaris',
        'note_sekretaris',
        'approval_ka_dinas',
        'name_ka_dinas',
        'note_ka_dinas',
    ];

    public function progresDocument()
    {
        //return $this->hasOne(ProgresDocument::class);
        return $this->hasOne(ProgresDocument::class, 'id', 'progres_document_id');
    }
}
