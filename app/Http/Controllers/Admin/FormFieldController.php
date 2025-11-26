<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    public function index()
    {
        $fields = FormField::orderBy('section')->orderBy('sort_order')->get();

        return view('admin.form_fields.index', compact('fields'));
    }

    public function create()
    {
        $types = ['text','number','textarea','select','radio','date','email','phone'];
        $sections = [
            'Personal'     => 'Personal Details',
            'Home Address' => 'Home Address',
            'Workplace'    => 'Workplace Address',
            'Nominee 1'    => 'Nominee Details 1',
            'Nominee 2'    => 'Nominee Details 2',
            'Other'        => 'Other',
        ];

        return view('admin.form_fields.create', compact('types', 'sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'        => 'required|string|max:255',
            'name'         => 'required|string|max:255|alpha_dash|unique:form_fields,name',
            'type'         => 'required|string',
            'section'      => 'nullable|string|max:100',
            'options_text' => 'nullable|string',
            'is_required'  => 'nullable|boolean',
            'is_active'    => 'nullable|boolean',
            'sort_order'   => 'nullable|integer',
        ]);

        $data['is_required'] = $request->has('is_required');
        $data['is_active']   = $request->has('is_active');
        $data['sort_order']  = $data['sort_order'] ?? 0;

        FormField::create($data);

        return redirect()->route('admin.formfields.index')
            ->with('success', 'Field created successfully.');
    }

    public function edit($id)
    {
        $field = FormField::findOrFail($id);
        $types = ['text','number','textarea','select','radio','date','email','phone'];
        $sections = [
            'Personal'     => 'Personal Details',
            'Home Address' => 'Home Address',
            'Workplace'    => 'Workplace Address',
            'Nominee 1'    => 'Nominee Details 1',
            'Nominee 2'    => 'Nominee Details 2',
            'Other'        => 'Other',
        ];

        return view('admin.form_fields.edit', compact('field','types','sections'));
    }

    public function update(Request $request, $id)
    {
        $field = FormField::findOrFail($id);

        $data = $request->validate([
            'label'        => 'required|string|max:255',
            'name'         => 'required|string|max:255|alpha_dash|unique:form_fields,name,' . $field->id,
            'type'         => 'required|string',
            'section'      => 'nullable|string|max:100',
            'options_text' => 'nullable|string',
            'is_required'  => 'nullable|boolean',
            'is_active'    => 'nullable|boolean',
            'sort_order'   => 'nullable|integer',
        ]);

        $data['is_required'] = $request->has('is_required');
        $data['is_active']   = $request->has('is_active');
        $data['sort_order']  = $data['sort_order'] ?? 0;

        $field->update($data);

        return redirect()->route('admin.formfields.index')
            ->with('success', 'Field updated successfully.');
    }

    public function destroy($id)
    {
        $field = FormField::findOrFail($id);
        $field->delete();

        return redirect()->route('admin.formfields.index')
            ->with('success', 'Field deleted successfully.');
    }
}
