<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Auth::user()->assignments()->with('asset')->latest()->get();
        return view('technician.assets.index', compact('assignments'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        $assignment = $asset->assignment;
        
        if (!$assignment || $assignment->technician_id !== Auth::id()) {
            abort(404);
        }

        return view('technician.assets.show', compact('asset', 'assignment'));
    }

    /**
     * Mark an asset as fixed.
     */
    public function markAsFixed(Asset $asset)
    {
        $assignment = $asset->assignment;
        
        if (!$assignment || $assignment->technician_id !== Auth::id()) {
            abort(404);
        }

        if ($asset->status !== 'assigned') {
            return back()->with('error', 'Can only mark assigned assets as fixed.');
        }

        $asset->update(['status' => 'fixed']);
        $assignment->update(['fixed_at' => now()]);

        return redirect()->route('technician.assets.index')
            ->with('success', 'Asset marked as fixed successfully.');
    }
}
