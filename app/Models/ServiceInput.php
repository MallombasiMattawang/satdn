<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceInput extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 
        'input',
        'option',
        'type',
        'required',
        'default'        
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
