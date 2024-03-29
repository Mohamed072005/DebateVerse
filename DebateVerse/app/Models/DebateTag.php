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
        return $this->belongsTo(Debate::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'debates_tags');
    }
}
