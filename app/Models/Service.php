<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'service_type_id',
        'description',        
        'retribution',
        'tim_teknis',
        'admin_teknis',
        'period_of_time',
        'active',
        'format_number',
        'template_surat'

    ];

    public function documents()
    {
        return $this->belongsToMany(Document::class);
    }

    public function inputs()
    {
        return $this->belongsToMany(ServiceInput::class);
    }


    public function serviceType()
    {
        return $this->hasOne(ServiceType::class, 'id', 'service_type_id');
    }

    public function adminUser()
    {
        return $this->hasOne(AdminUser::class, 'id', 'admin_teknis');
    }
    
}
