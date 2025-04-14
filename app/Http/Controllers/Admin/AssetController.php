<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function index()
    {
        $assets = Asset::latest()->get();
        return view('admin.assets.index', compact('assets'));
    }

    public function create()
    {
        return view('admin.assets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'defect_description' => ['required', 'string'],
        ]);

        Asset::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'defect_description' => $request->defect_description,
            'status' => 'defective',
        ]);

        return redirect()->route('admin.assets.index')
            ->with('success', 'Asset created successfully.');
    }

    public function show(Asset $asset)
    {
        return view('admin.assets.show', compact('asset'));
    }

    public function edit(Asset $asset)
    {
        return view('admin.assets.edit', compact('asset'));
    }

    public function update(Request $request, Asset $asset)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'defect_description' => ['required', 'string'],
        ]);

        $asset->update([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'defect_description' => $request->defect_description,
        ]);

        return redirect()->route('admin.assets.index')
            ->with('success', 'Asset updated successfully.');
    }

    public function destroy(Asset $asset)
    {
        $asset->delete();
        return redirect()->route('admin.assets.index')
            ->with('success', 'Asset deleted successfully.');
    }
}
