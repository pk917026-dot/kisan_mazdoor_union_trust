<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotificationSetting;

class NotificationSettingController extends Controller
{
    public function index() {
        $settings = NotificationSetting::all()->keyBy('channel');
        return view('admin.notifications.settings', compact('settings'));
    }

    public function save(Request $request) {
        // email
        $email = NotificationSetting::firstOrNew(['channel'=>'email']);
        $email->enabled = $request->email_enabled ? 1 : 0;
        $email->sender_name = $request->email_sender_name;
        $email->email_host = $request->email_host;
        $email->email_port = $request->email_port;
        $email->email_username = $request->email_username;
        if($request->email_password){
            $email->email_password = $request->email_password; // real project: encrypt!
        }
        $email->email_encryption = $request->email_encryption;
        $email->save();

        // sms
        $sms = NotificationSetting::firstOrNew(['channel'=>'sms']);
        $sms->enabled = $request->sms_enabled ? 1 : 0;
        $sms->sms_api_url = $request->sms_api_url;
        $sms->sms_api_key = $request->sms_api_key;
        $sms->sms_sender = $request->sms_sender;
        $sms->save();

        // whatsapp
        $wa = NotificationSetting::firstOrNew(['channel'=>'whatsapp']);
        $wa->enabled = $request->wa_enabled ? 1 : 0;
        $wa->wa_api_url = $request->wa_api_url;
        $wa->wa_api_key = $request->wa_api_key;
        $wa->wa_number = $request->wa_number;
        $wa->save();

        return back()->with('success','Notification settings updated');
    }
}
