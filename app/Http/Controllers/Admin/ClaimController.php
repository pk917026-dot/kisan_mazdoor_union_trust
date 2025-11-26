<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormSubmission;
use App\Models\NotificationSetting;
use Illuminate\Support\Facades\Mail;

class ClaimController extends Controller
{
    /**
     * List all claim submissions (linked to the `claim` form).
     */
    public function index()
    {
        $form = Form::where('slug', 'claim')->first();

        if ($form) {
            $claims = $form->submissions()->latest()->get();
        } else {
            $claims = FormSubmission::latest()->get();
        }

        return view('admin.claims.index', compact('claims'));
    }

    /**
     * Show a single claim submission.
     */
    public function view($id)
    {
        $submission = FormSubmission::findOrFail($id);

        return view('admin.claims.view', compact('submission'));
    }

    /**
     * Update status + remarks, then trigger notifications.
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status'        => 'required|in:pending,approved,rejected',
            'admin_remarks' => 'nullable|string|max:2000',
        ]);

        $claim = FormSubmission::findOrFail($id);
        $claim->status        = $validated['status'];
        $claim->admin_remarks = $validated['admin_remarks'] ?? null;
        $claim->save();

        $this->sendNotifications_Auto($claim);

        return back()->with('success', 'Claim Status Updated');
    }

    /**
     * Auto notification hooks (email + future SMS/WhatsApp).
     */
    private function sendNotifications_Auto(FormSubmission $claim)
    {
        $data   = $claim->data ?? [];
        $mobile = $data['mobile'] ?? null;
        $email  = $data['email']  ?? null;

        $message = 'Your claim status has been updated to: ' . ucfirst($claim->status);

        if (! empty($claim->admin_remarks)) {
            $message .= "\nRemarks: " . $claim->admin_remarks;
        }

        // 1) SMS (stub only, actual API integration can be added later)
        $smsSet = NotificationSetting::where('channel', 'sms')->first();
        if ($smsSet && $smsSet->enabled && $mobile) {
            // यहाँ future में SMS API integrate कर सकते हैं
        }

        // 2) Email
        $emailSet = NotificationSetting::where('channel', 'email')->first();
        if ($emailSet && $emailSet->enabled && $email) {
            Mail::raw($message, function ($msg) use ($email, $emailSet) {
                $msg->to($email)
                    ->subject('Claim Status Update')
                    ->from($emailSet->email_username, $emailSet->sender_name);
            });
        }
    }
}
