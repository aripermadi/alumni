<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class JobsController extends Controller
{
    public function index()
    {
        $jobs = Job::orderByDesc('created_at')->get();
        return view('modules.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('modules.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'company' => 'required',
            'location' => 'required',
            'deadline' => 'nullable|date',
            'link' => 'nullable|url',
            'status' => 'required|in:open,closed',
            'logo' => 'nullable|image|max:5120',
        ]);
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            if ($file->getSize() > 2048 * 1024) {
                $img = Image::make($file)->resize(300, 300, function ($c) { $c->aspectRatio(); $c->upsize(); })->encode('jpg', 80);
                $filename = 'jobs/' . uniqid() . '.jpg';
                \Storage::disk('public')->put($filename, $img);
                $logoPath = $filename;
            } else {
                $logoPath = $file->store('jobs', 'public');
            }
        }
        Job::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'company' => $request->company,
            'location' => $request->location,
            'deadline' => $request->deadline,
            'link' => $request->link,
            'status' => $request->status,
            'logo' => $logoPath,
        ]);
        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil ditambahkan.');
    }

    public function show(Job $job)
    {
        return view('modules.jobs.show', compact('job'));
    }

    public function edit(Job $job)
    {
        return view('modules.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'company' => 'required',
            'location' => 'required',
            'deadline' => 'nullable|date',
            'link' => 'nullable|url',
            'status' => 'required|in:open,closed',
            'logo' => 'nullable|image|max:5120',
        ]);
        $data = $request->only(['title','description','company','location','deadline','link','status']);
        if ($request->hasFile('logo')) {
            if ($job->logo) {
                \Storage::disk('public')->delete($job->logo);
            }
            $file = $request->file('logo');
            if ($file->getSize() > 2048 * 1024) {
                $img = Image::make($file)->resize(300, 300, function ($c) { $c->aspectRatio(); $c->upsize(); })->encode('jpg', 80);
                $filename = 'jobs/' . uniqid() . '.jpg';
                \Storage::disk('public')->put($filename, $img);
                $data['logo'] = $filename;
            } else {
                $data['logo'] = $file->store('jobs', 'public');
            }
        }
        $job->update($data);
        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil diupdate.');
    }

    public function destroy(Job $job)
    {
        if ($job->logo) {
            \Storage::disk('public')->delete($job->logo);
        }
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Lowongan berhasil dihapus.');
    }

    public function all()
    {
        $jobs = Job::orderByDesc('created_at')->get();
        return view('modules.jobs.all', compact('jobs'));
    }

    public function publicShow($id)
    {
        $job = Job::findOrFail($id);
        return view('modules.jobs.public_show', compact('job'));
    }
} 