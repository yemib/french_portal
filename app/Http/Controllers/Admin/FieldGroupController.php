<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldGroup;
use Illuminate\Http\Request;

class FieldGroupController extends Controller
{
    public function index()
    {
        return FieldGroup::orderBy('order')->get();
    }

    public function store(Request $request)
    {
        $order = FieldGroup::max('order') + 1;

        $group = FieldGroup::create([
            'name' => $request->name,
            'order' => $order
        ]);

        return response()->json($group);
    }

    public function update(Request $request, FieldGroup $fieldGroup)
    {
        $fieldGroup->update([
            'name' => $request->name
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(FieldGroup $fieldGroup)
    {
        $fieldGroup->delete();

        // Re-order remaining groups
        FieldGroup::orderBy('order')->get()->each(function ($group, $index) {
            $group->update(['order' => $index + 1]);
        });

        return response()->json(['success' => true]);
    }

    public function reorder(Request $request)
    {
        foreach ($request->orders as $id => $order) {
            FieldGroup::where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['success' => true]);
    }
}