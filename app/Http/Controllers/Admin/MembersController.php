<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MemberRegistration;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $query = MemberRegistration::with('values.field')->latest();

        if ($status) {
            $query->where('status', $status);
        }

        $members = $query->paginate(20);

        return view('admin.members.index', compact('members', 'status'));
    }

    public function show($id)
    {
        $member = MemberRegistration::with('values.field')->findOrFail($id);

        $grouped = $member->values->groupBy(function ($item) {
            return $item->field->section ?? 'Other';
        });

        return view('admin.members.show', compact('member', 'grouped'));
    }

    public function updateStatus(Request $request, $id)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $member = MemberRegistration::findOrFail($id);
        $member->status = $data['status'];
        $member->save();

        return back()->with('success', 'स्टेटस सफलतापूर्वक अपडेट हो गया।');
    }
}
