<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        return view('admin.features.index', compact('features'));
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);
        Feature::create($request->only(['name_en', 'name_ar']));
        return redirect()->route('features.index')->with('success', 'Feature added successfully');
    }

    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        return view('admin.features.edit', compact('feature'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'name_ar' => 'required|string|max:255',
        ]);
        $feature = Feature::findOrFail($id);
        $feature->update($request->only(['name_en', 'name_ar']));
        return redirect()->route('features.index')->with('success', 'Feature updated successfully');
    }

    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();
        return redirect()->route('features.index')->with('success', 'Feature deleted successfully');
    }
}
