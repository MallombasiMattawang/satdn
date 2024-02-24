<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresServiceInput extends Model
{
    use HasFactory;

    protected $fillable = [        
        'progres_document_id', 
        'service_input_id', 
        'kode',
        'input_name', 
        'value'
        
    ];
}
