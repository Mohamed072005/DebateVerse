<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebateTag extends Model
{
    use HasFactory;
    protected $table = 'debates_tags';
    protected $fillable = [
        'debate_id',
        'tag_id'
    ];

    public function debates()
    {
        return $this->belongsToMany(Debate::class, 'debates_tags', 'tag_id', 'debate_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'debates_tags');
    }
}
