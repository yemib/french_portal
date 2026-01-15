<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldGroup;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    public function index()
    {
        $fields = FormField::orderBy('order')->get();
        $groups   = FieldGroup::orderBy('order')->get();


        return view('form-fields.index', compact('fields', 'groups'));
    }

    public function store(Request $request)
    {

        $order = FormField::where('field_group_id', $request->field_group_id)
            ->max('order') + 1;

        $field = FormField::create([
            'label' => $request->label,
            'name' => $request->name,
            'type' => $request->type,
            'placeholder' => $request->placeholder,
            'required' => $request->required == 'true',
            'field_group_id' => $request->field_group_id,
            'order' => $order,
            'options' => $request->options
                ? json_encode(explode(',', $request->options))
                : null,
        ]);

        return response()->json($field);
    }

    public function reorder(Request $request)
    {
        foreach ($request->orders as $id => $order) {
            \App\Models\FormField::where('id', $id)
                ->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }


    public function update(Request $request, FormField $formField)
    {
        $formField->update([
            'label' => $request->label,
            'type' => $request->type,
            'placeholder' => $request->placeholder,
            'required' => $request->required == 'true',
            'field_group_id' => $request->field_group_id,

            'options' => $request->options
                ? json_encode(explode(',', $request->options))
                : null,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(FormField $formField)
    {
        $formField->delete();
        FormField::where('field_group_id', $formField->field_group_id)
            ->orderBy('order')
            ->get()
            ->each(function ($field, $index) {
                $field->update(['order' => $index + 1]);
            });


        return response()->json(['success' => true]);
    }
}
