<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'last_name',
        'telephone_number',
        'username',
        'birthday',
        'avatar',
        'password',
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

    //relations
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function sended_messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function received_messages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function seguidores()
    {
        return $this->belongsTo(Follower::class, 'follower_id');
    }

    public function seguidos()
    {
        return $this->belongsTo(Follower::class, 'account_id');
    }
}
