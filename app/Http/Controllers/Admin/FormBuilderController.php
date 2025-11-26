<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\FormField;

class FormBuilderController extends Controller
{
    public function index() {
        $forms = Form::orderBy('id','DESC')->get();
        return view('admin.forms.index', compact('forms'));
    }

    public function create() {
        return view('admin.forms.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:forms,slug',
        ]);

        Form::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->is_active ? 1 : 0
        ]);

        return redirect()->route('admin.forms')->with('success','Form created');
    }

    public function edit($id) {
        $form = Form::findOrFail($id);
        $fields = $form->fields;
        return view('admin.forms.edit', compact('form','fields'));
    }

    public function update(Request $request, $id) {
        $form = Form::findOrFail($id);

        $form->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->is_active ? 1 : 0
        ]);

        return back()->with('success','Form updated');
    }

    public function delete($id) {
        Form::findOrFail($id)->delete();
        return back()->with('success','Form deleted');
    }

    // FIELD METHODS
    public function storeField(Request $request, $id) {
        $form = Form::findOrFail($id);

        $request->validate([
            'label' => 'required',
            'name'  => 'required',
            'type'  => 'required',
        ]);

        $options = null;
        if (in_array($request->type, ['select','radio','checkbox']) && $request->options) {
            // options comma separated → array
            $optsArray = array_map('trim', explode(',', $request->options));
            $options = json_encode($optsArray);
        }

        FormField::create([
            'form_id' => $form->id,
            'label' => $request->label,
            'name' => $request->name,
            'type' => $request->type,
            'is_required' => $request->is_required ? 1 : 0,
            'options' => $options,
            'validation_rules' => $request->validation_rules,
            'order' => FormField::where('form_id',$form->id)->count() + 1,
            'is_active' => 1
        ]);

        return back()->with('success','Field added');
    }

    public function deleteField($form_id, $field_id) {
        FormField::where('form_id',$form_id)->where('id',$field_id)->delete();
        return back()->with('success','Field deleted');
    }

    public function updateFieldOrder(Request $request, $id) {
        // $request->order = [field_id => order]
        foreach ($request->order as $field_id => $order) {
            FormField::where('id',$field_id)->update(['order' => $order]);
        }
        return response()->json(['success'=>true]);
    }
}
