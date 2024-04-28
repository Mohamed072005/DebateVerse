<?php

namespace App\Models;

use App\Http\Controllers\SuggestionsToAdminController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\Console\Completion\Suggestion;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
        'phone_number',
        'role_id',
        'gender_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function debates()
    {
        return $this->hasMany(Debate::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function votings()
    {
        return $this->hasMany(Voting::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function sendRequest()
    {
        return $this->hasMany(Friend::class, 'sender_id');
    }

    public function receiveRequest(){
        return $this->hasMany(Friend::class, 'receiver_id');
    }

    public function notificationSender()
    {
        return $this->hasMany(Notification::class, 'from_user_id');
    }

    public function notificationReceiver(){
        return $this->hasMany(Notification::class, 'to_user_id');
    }

    public function sendSuggestions()
    {
        return $this->hasMany(SuggestionsToAdmin::class, 'from_user_id');
    }

    public function receiverSuggestionsMessage(){
        return $this->hasMany(SuggestionsToAdmin::class, 'to_user_id');
    }
}
