<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Event::orderByDesc('event_date');
        if ($request->has('q') && $request->q) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        $events = $query->get();
        return view('modules.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required',
            'image' => 'nullable|image|max:5120',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $category = $request->category_id ?? 'uncategorized';
            $folder = 'events/' . $category;
            if ($file->getSize() > 2048 * 1024) {
                $img = Image::make($file)->resize(800, 600, function ($c) { $c->aspectRatio(); $c->upsize(); })->encode('jpg', 80);
                $filename = $folder . '/' . uniqid() . '.jpg';
                \Storage::disk('public')->put($filename, $img);
                $imagePath = $filename;
            } else {
                $imagePath = $file->store($folder, 'public');
            }
        }
        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'user_id' => Auth::id(),
            'image' => $imagePath,
        ]);
        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return view('modules.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        return view('modules.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required',
            'image' => 'nullable|image|max:5120',
        ]);
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
        ];
        if ($request->hasFile('image')) {
            if ($event->image) {
                \Storage::disk('public')->delete($event->image);
            }
            $file = $request->file('image');
            $category = $request->category_id ?? ($event->category_id ?? 'uncategorized');
            $folder = 'events/' . $category;
            if ($file->getSize() > 2048 * 1024) {
                $img = Image::make($file)->resize(800, 600, function ($c) { $c->aspectRatio(); $c->upsize(); })->encode('jpg', 80);
                $filename = $folder . '/' . uniqid() . '.jpg';
                \Storage::disk('public')->put($filename, $img);
                $data['image'] = $filename;
            } else {
                $data['image'] = $file->store($folder, 'public');
            }
        }
        $event->update($data);
        return redirect()->route('events.index')->with('success', 'Event berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }

    /**
     * Tampilkan semua event untuk user (tanpa tombol admin).
     */
    public function all(Request $request)
    {
        $query = Event::orderByDesc('event_date');
        if ($request->has('q') && $request->q) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        $events = $query->get();
        return view('modules.events.all', compact('events'));
    }

    /**
     * Tampilkan detail event untuk user/pengunjung (tanpa login).
     */
    public function publicShow($id)
    {
        $event = Event::findOrFail($id);
        return view('modules.events.public_show', compact('event'));
    }

    public function ajaxAll(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 6;
        $query = Event::orderByDesc('event_date');
        if ($request->has('q') && $request->q) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        $events = $query->paginate($perPage, ['*'], 'page', $page);
        $html = view('modules.events._events_grid', ['events' => $events])->render();
        return response()->json([
            'events' => $html,
            'hasMore' => $events->hasMorePages()
        ]);
    }
}
