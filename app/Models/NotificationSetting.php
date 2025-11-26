<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    protected $fillable = [
        'channel','enabled','sender_name','sender_id',
        'email_host','email_port','email_username','email_password','email_encryption',
        'sms_api_url','sms_api_key','sms_sender',
        'wa_api_url','wa_api_key','wa_number'
    ];
}
