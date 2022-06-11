<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOtpVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobile',
        'sendOtp',
        'check_status',
        'request_id',
        'otpType'
    ];
}
