<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class CommunitySatisfactionIndex extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;

    protected $table = 'community_satisfaction_indexs';

    protected $fillable = [
        'name', 
        'service', 
        'rate', 
        'testimony'
    ];
}
