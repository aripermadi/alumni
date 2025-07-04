<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    // Tampilkan daftar alumni
    public function index(Request $request)
    {
        $query = Alumni::with('user');
        if ($request->has('q') && $request->q) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%');
            });
        }
        $alumni = $query->orderByDesc('id')->paginate(12);
        return view('modules.alumni.index', compact('alumni'));
    }

    // Tampilkan detail alumni
    public function show($id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);
        return view('modules.alumni.show', compact('alumni'));
    }
} 