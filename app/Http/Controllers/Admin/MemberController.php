<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class MemberController extends Controller
{
    public function index() {
        $members = Member::orderBy('id','DESC')->get();
        return view('admin.members.index', compact('members'));
    }

    public function create() {
        return view('admin.members.create');
    }

    public function store(Request $request) {

        $member = new Member();

        $member->membership_id = 'KMUT'.time(); // Auto ID
        $member->name = $request->name;
        $member->father_name = $request->father_name;
        $member->mobile = $request->mobile;
        $member->whatsapp = $request->whatsapp;
        $member->email = $request->email;
        $member->dob = $request->dob;

        $member->address = $request->address;
        $member->district = $request->district;
        $member->state = $request->state;
        $member->pincode = $request->pincode;

        $member->aadhaar = $request->aadhaar;
        $member->pan = $request->pan;

        if($request->hasFile('photo')){
            $member->photo = $request->file('photo')->store('uploads/members','public');
        }

        $member->save();

        return redirect()->route('admin.members')->with('success','Member Added Successfully');
    }

    public function edit($id) {
        $member = Member::find($id);
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, $id) {

        $member = Member::find($id);

        $member->name = $request->name;
        $member->father_name = $request->father_name;
        $member->mobile = $request->mobile;
        $member->whatsapp = $request->whatsapp;
        $member->email = $request->email;
        $member->dob = $request->dob;

        $member->address = $request->address;
        $member->district = $request->district;
        $member->state = $request->state;
        $member->pincode = $request->pincode;

        $member->aadhaar = $request->aadhaar;
        $member->pan = $request->pan;

        if($request->hasFile('photo')){
            $member->photo = $request->file('photo')->store('uploads/members','public');
        }

        $member->save();

        return redirect()->route('admin.members')->with('success','Member Updated');
    }

    public function delete($id) {
        Member::find($id)->delete();
        return back()->with('success','Member Deleted');
    }
}
