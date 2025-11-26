public function index() {

    $claimForm = Form::where('slug','claim')->first();

    $claims_total = FormSubmission::where('form_id',$claimForm->id)->count();
    $claims_pending = FormSubmission::where('form_id',$claimForm->id)->where('status','pending')->count();
    $claims_approved = FormSubmission::where('form_id',$claimForm->id)->where('status','approved')->count();
    $claims_rejected = FormSubmission::where('form_id',$claimForm->id)->where('status','rejected')->count();

    return view('admin.dashboard',compact(
        'claims_total','claims_pending','claims_approved','claims_rejected'
    ));
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberRegistration;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total'    => MemberRegistration::count(),
            'pending'  => MemberRegistration::where('status', 'pending')->count(),
            'approved' => MemberRegistration::where('status', 'approved')->count(),
            'rejected' => MemberRegistration::where('status', 'rejected')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
