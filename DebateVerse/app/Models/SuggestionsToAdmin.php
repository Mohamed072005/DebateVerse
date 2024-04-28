<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionsToAdmin extends Model
{
    use HasFactory;
    protected $table = 'suggestions_to_admins';
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'suggestion',
    ];

    public function sender(){
        return $this->belongsTo(User::class,'from_user_id');
    }

    public function receiver(){
        return $this->belongsTo(User::class,'to_user_id');
    }
}
