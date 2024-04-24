<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'message'
    ];

    public function notificationSender()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function notificationReceiver(){
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
