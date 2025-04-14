<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = User::where('role', 'technician')->latest()->get();
        return view('admin.technicians.index', compact('technicians'));
    }

    public function create()
    {
        return view('admin.technicians.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('tec@123'),
            'role' => 'technician',
        ]);

        return redirect()->route('admin.technicians.index')
            ->with('success', 'Technician created successfully.');
    }

    public function show(User $technician)
    {
        if ($technician->role !== 'technician') {
            abort(404);
        }
        
        return view('admin.technicians.show', compact('technician'));
    }

    public function edit(User $technician)
    {
        if ($technician->role !== 'technician') {
            abort(404);
        }
        
        return view('admin.technicians.edit', compact('technician'));
    }

    public function update(Request $request, User $technician)
    {
        if ($technician->role !== 'technician') {
            abort(404);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users,email,' . $technician->id],
        ]);

        $technician->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.technicians.index')
            ->with('success', 'Technician updated successfully.');
    }

    public function destroy(User $technician)
    {
        if ($technician->role !== 'technician') {
            abort(404);
        }

        $technician->delete();

        return redirect()->route('admin.technicians.index')
            ->with('success', 'Technician deleted successfully.');
    }
}
