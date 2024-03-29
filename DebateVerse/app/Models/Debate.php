<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debate extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'img',
        'user_id',
        'categorie_id'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'debates_tags');
    }
}
