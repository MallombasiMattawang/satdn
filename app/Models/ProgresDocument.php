<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\ProgresApproval;
use App\Models\AdminUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgresDocument extends Model
{
    use HasFactory, SoftDeletes;
    use DefaultDatetimeFormat;

    protected $fillable = [
        'user_id',
        'service_id',
        'no_invoice',
        'applicant_name',
        'nik',
        'no_kk',
        'npwp',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'phone_number',
        'address_ktp',
        'status',
        'date_start_progres',
        'date_verified_doc',
        'note_verified_doc',
        'verifikator',
        'admin_teknis',
        'date_verified_teknis',
        'note_verified_teknis',  
        'doc_verified_teknis',      
        'verifikator_teknis',
        'approval',
        'date_end_progres',
        'format_number',
        'number_letter',
        'date_letter',
        'signature_digital',
        'signature_by',
        'signature_position',
        'signature_id_number',
        'passphrase',
        'temp_file_permit',
        'file_permit',
        'status_send',
        'ikm',
        'note_ikm',
        'rate_ikm'

    ];

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function created_at_difference()
    {
        //  return Carbon::createFromFormat('m/d/Y',$this->created_at);
        //return Carbon::parse($this->created_at)->format('d-m-Y');
        return Carbon::parse(strtotime($this->created_at))->format('M d, Y');
    }

   public function update_at_difference()
    {
        return Carbon::parse(strtotime($this->updated_at))->format('M d, Y | H:i');
    }
    public function dateStart()
    {
        if ($this->date_start_progres) {
            $carbon = Carbon::parse($this->date_start_progres)->format('M d, Y | H:i');
        } else {
            $carbon = 'PENDING';
        }
        return $carbon;
    }

    public function dateDoc()
    {
        if ($this->date_verified_doc) {
            $carbon = Carbon::parse($this->date_verified_doc)->format('M d, Y | H:i');
        } else {
            $carbon = 'PENDING';
        }
        return $carbon;
        
    }

    public function dateTeknis()
    {
        if ($this->date_verified_teknis) {
            $carbon = Carbon::parse($this->date_verified_teknis)->format('M d, Y | H:i');
        } else {
            $carbon = 'PENDING';
        }
        return $carbon;
        
    }

    public function dateEnd()
    {
        if ($this->date_end_progres) {
            $carbon = Carbon::parse($this->date_end_progres)->format('M d, Y | H:i');
        } else {
            $carbon = 'PENDING';
        }
        return $carbon;
        
    }

    public function getDateEndProgres(){
        return Carbon::parse($this->date_end_progres)->translatedFormat('l, d F Y');
    }
    


    public function progresServiceDocument()
    {
        $progresDocument = ProgresServiceDocument::where('progres_document_id', $this->id)->get();
        return $progresDocument;
    }

    public function documents()
    {
        return $this->hasMany(ProgresServiceDocument::class);
    }

    public function inputs()
    {
        return $this->hasMany(ProgresServiceInput::class);
    }

    public function ProgresApproval()
    {
        return $this->hasOne(ProgresApproval::class, 'progres_document_id','id');
    }

    public function AdminTeknis()
    {
        return $this->hasOne(AdminUser::class, 'id','admin_teknis');
    }
    
}
