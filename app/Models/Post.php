<?php

namespace App\Models;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id', 
        'content', 
        'rate', 
        'released', 
        //'tags'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    
}
