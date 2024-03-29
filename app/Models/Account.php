<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Account extends Model
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
