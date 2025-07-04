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
        $alumni = $query->orderBy('angkatan')->get()->groupBy('angkatan');
        return view('modules.alumni.index', compact('alumni'));
    }

    // Tampilkan detail alumni
    public function show($id)
    {
        $alumni = Alumni::with('user')->findOrFail($id);
        return view('modules.alumni.show', compact('alumni'));
    }

    public function ajaxAngkatan(Request $request)
    {
        $page = $request->get('page', 1);
        $angkatanList = Alumni::select('angkatan')->distinct()->orderBy('angkatan')->pluck('angkatan')->values();
        $angkatan = $angkatanList[$page - 1] ?? null;
        $alumni = $angkatan ? Alumni::with('user')->where('angkatan', $angkatan)->get() : collect();
        $html = view('modules.alumni._alumni_grid', compact('alumni', 'angkatan'))->render();
        return response()->json([
            'angkatan' => $angkatan,
            'alumni' => $html,
            'hasMore' => $page < count($angkatanList)
        ]);
    }
} 