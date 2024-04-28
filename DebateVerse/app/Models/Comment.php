<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'debate_id',
        'user_id',
        'content',
        'report',
        'status'
    ];

    public function debate()
    {
        return $this->belongsTo(Debate::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
