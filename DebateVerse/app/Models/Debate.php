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
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'debates_tags');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voting()
    {
        return $this->hasMany(Voting::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
