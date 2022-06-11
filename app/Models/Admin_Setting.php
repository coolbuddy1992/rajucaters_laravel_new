<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_Setting extends Model
{
    use HasFactory;
    protected $table = 'admin_settings';
    protected $fillable = [
        'website_title',
        'website_favicon',
        'website_logo',
        'website_logo_pubic_id',
        'website_favicon_public_id',
        'website_address',
        'website_address_city',
        'website_address_state',
        'website_address_pin',
        'website_email',
        'website_phone_1',
        'website_phone_2',
        'website_phone_3',
        'website_phone_4',
        'other_fields',
        'sms_api_key',
    ];
}
