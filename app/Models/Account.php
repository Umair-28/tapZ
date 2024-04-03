<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $guarded = [];
    // protected $fillable = [
    //     'fullName',
    //     'email',
    //     'password',
    //     'loginWith',
    //     'platform',
    //     'fcmToken',
    //     'googleId',
    //     'facebookId',
    //     'appleId'
    // ];
}
