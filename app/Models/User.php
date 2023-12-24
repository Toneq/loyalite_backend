<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'token',
    ];

    protected $casts = [];

    public static function findByTwitchId($id){
        return User::where('twitch_id', $id)->first();
    }

    public static function findByToken($token){
        return User::where('token', $token)->first();
    }

    public static function findPatrons($user){
        $patrons = User::select('users.name', 'users.avatar', 'users.id')
            ->join('patrons', 'patrons.redeem', '=', 'users.id')
            ->where('patrons.channel', $user)
            ->get();
        return $patrons;
    }

    public static function findPatronizes($user){
        $patronizes = User::select('users.name', 'users.avatar', 'users.id')
            ->join('patrons', 'patrons.channel', '=', 'users.id')
            ->where('patrons.redeem', $user)
            ->get();
        return $patronizes;
    }
}
