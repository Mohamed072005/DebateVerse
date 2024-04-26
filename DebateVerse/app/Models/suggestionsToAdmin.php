<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suggestionsToAdmin extends Model
{
    use HasFactory;
    protected $table = 'suggestions_to_admins';
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'suggestion',
    ];
}
