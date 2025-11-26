<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    public function index() {
        $complaints = Complaint::orderBy('id','DESC')->get();
        return view('admin.complaint.index', compact('complaints'));
    }

    public function view($id) {
        $complaint = Complaint::find($id);
        return view('admin.complaint.view', compact('complaint'));
    }
}
