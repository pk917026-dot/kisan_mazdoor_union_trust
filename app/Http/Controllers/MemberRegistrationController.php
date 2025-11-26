<?php

namespace App\Http\Controllers;

use App\Models\FormField;
use App\Models\MemberRegistration;
use App\Models\MemberFieldValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberRegistrationController extends Controller
{
    public function showForm()
    {
        // सारे active fields लाओ और section के हिसाब से group करो
        $fields = FormField::active()->get()->groupBy('section');

        return view('member.register', compact('fields'));
    }

    public function submitForm(Request $request)
    {
        $fields = FormField::active()->get();

        // 1) Dynamic Validation Rules
        $rules = [];
        foreach ($fields as $field) {
            $rule = [];

            $rule[] = $field->is_required ? 'required' : 'nullable';

            switch ($field->type) {
                case 'email':
                    $rule[] = 'email';
                    break;
                case 'number':
                    $rule[] = 'numeric';
                    break;
                case 'date':
                    $rule[] = 'date';
                    break;
                default:
                    $rule[] = 'string';
                    break;
            }

            $rules[$field->name] = implode('|', $rule);
        }

        $validated = $request->validate($rules);

        DB::beginTransaction();

        try {
            // 2) New member row
            $member = MemberRegistration::create([
                'status' => 'pending',
            ]);

            // 3) हर field की value save करो
            foreach ($fields as $field) {
                $value = $validated[$field->name] ?? null;

                MemberFieldValue::create([
                    'member_id' => $member->id,
                    'field_id'  => $field->id,
                    'value'     => is_array($value) ? json_encode($value) : $value,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('member.register')
                ->with('success', 'आपका रजिस्ट्रेशन सफलतापूर्वक सबमिट हो गया है। आपका स्टेटस अभी PENDING है।');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->with('error', 'कुछ गड़बड़ हो गई, कृपया दोबारा प्रयास करें।')
                ->withInput();
        }
    }
}
