<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProgresServiceDocument extends Model
{
    use HasFactory;

    protected $fillable = [        
        'progres_document_id',
        'document_id',   
        'document_name',
        'document_type',
        'document_max',
        'file_document',
        'required',
        
    ];

    public function progresDocument()
    {
        return $this->hasOne(progresDocument::class);
        //return $this->belongsToMany(progresDocument::class);
    }

    

    public function getCreatedAtAttribute($created_at)
    {
        return Carbon::parse($created_at)
            ->getPreciseTimestamp(3);
    }

    public function getUpdatedAtAttribute($updated_at)
    {
        return Carbon::parse($updated_at)
            ->getPreciseTimestamp(3);
    }
}
