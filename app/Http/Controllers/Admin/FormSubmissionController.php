<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormSubmission;

class FormSubmissionController extends Controller
{
    public function index($id) {
        $form = Form::findOrFail($id);
        $submissions = $form->submissions()->orderBy('id','DESC')->get();
        return view('admin.forms.submissions', compact('form','submissions'));
    }

    public function view($id, $submission_id) {
        $form = Form::findOrFail($id);
        $submission = FormSubmission::findOrFail($submission_id);
        return view('admin.forms.submission_view', compact('form','submission'));
    }
}
