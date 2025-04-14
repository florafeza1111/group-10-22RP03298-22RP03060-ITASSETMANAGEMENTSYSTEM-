<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Asset;
use App\Models\User;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['asset', 'technician'])->latest()->get();
        return view('admin.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $assets = Asset::where('status', 'defective')->get();
        $technicians = User::where('role', 'technician')->get();
        return view('admin.assignments.create', compact('assets', 'technicians'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asset_id' => ['required', 'exists:assets,id'],
            'technician_id' => ['required', 'exists:users,id'],
        ]);

        $asset = Asset::findOrFail($request->asset_id);
        
        if ($asset->status !== 'defective') {
            return back()->with('error', 'This asset is not available for assignment.');
        }

        Assignment::create([
            'asset_id' => $request->asset_id,
            'technician_id' => $request->technician_id,
        ]);

        $asset->update(['status' => 'assigned']);

        return redirect()->route('admin.assignments.index')
            ->with('success', 'Asset assigned successfully.');
    }

    public function show(Assignment $assignment)
    {
        return view('admin.assignments.show', compact('assignment'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        if ($assignment->asset->status === 'fixed') {
            $assignment->update(['approved_by_admin' => true]);
            $assignment->asset->update(['status' => 'approved']);
            
            return redirect()->route('admin.assignments.index')
                ->with('success', 'Asset repair has been approved.');
        }

        return back()->with('error', 'Asset must be marked as fixed by technician first.');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->asset->status === 'assigned') {
            $assignment->asset->update(['status' => 'defective']);
            $assignment->delete();
            
            return redirect()->route('admin.assignments.index')
                ->with('success', 'Assignment cancelled successfully.');
        }

        return back()->with('error', 'Cannot cancel assignment at current status.');
    }
}
