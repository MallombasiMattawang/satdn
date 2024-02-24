<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 
        'type_file', 
        'required',
        'max_file', 
        'sample_file'
    ];

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
