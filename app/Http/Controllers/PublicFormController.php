<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\NotificationSetting;

class PublicFormController extends Controller
{
    public function show($slug) {
        $form = Form::where('slug',$slug)->where('is_active',1)->firstOrFail();
        $fields = $form->fields()->where('is_active',1)->get();

        return view('public.dynamic_form', compact('form','fields'));
    }

    public function submit(Request $request, $slug) {
        $form = Form::where('slug',$slug)->where('is_active',1)->firstOrFail();
        $fields = $form->fields()->where('is_active',1)->get();

        // 1) Validation rules build
        $rules = [];
        foreach ($fields as $field) {
            if ($field->validation_rules) {
                $rules[$field->name] = $field->validation_rules;
            } elseif ($field->is_required) {
                $rules[$field->name] = 'required';
            }
        }

        $validated = $request->validate($rules);

        // 2) Data collect
        $data = [];
        foreach ($fields as $field) {
            if ($field->type === 'file' && $request->hasFile($field->name)) {
                $path = $request->file($field->name)->store('uploads/forms/'.$form->slug,'public');
                $data[$field->name] = $path;
            } else {
                $data[$field->name] = $request->input($field->name);
            }
        }

        FormSubmission::create([
            'form_id' => $form->id,
            'data' => $data,
            'submitted_by_ip' => $request->ip(),
        ]);

        // 3) Notification hooks (stub – future API connect)
        $this->sendNotifications($form, $data);

        return back()->with('success','Form submitted successfully');
    }

    protected function sendNotifications($form, $data) {
        // NOTE: यहाँ सिर्फ structure दे रहे हैं,
        // future में आप अपनी API keys लगा कर असली call करेंगे।

        // Example: Email
        $emailSettings = NotificationSetting::where('channel','email')->first();
        if($emailSettings && $emailSettings->enabled) {
            // यहाँ Laravel Mail::to() वगैरह इस्तेमाल कर सकते हैं
            // या कोई भी email service.
        }

        // Example: SMS
        $smsSettings = NotificationSetting::where('channel','sms')->first();
        if($smsSettings && $smsSettings->enabled) {
            // Http::post($smsSettings->sms_api_url, [...]) वगैरह
        }

        // Example: WhatsApp
        $waSettings = NotificationSetting::where('channel','whatsapp')->first();
        if($waSettings && $waSettings->enabled) {
            // Http::post($waSettings->wa_api_url, [...]) वगैरह
        }
    }
}
