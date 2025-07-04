<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderByDesc('published_at')->get();
        return view('modules.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }
        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'user_id' => Auth::id(),
            'image' => $imagePath,
        ]);
        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('modules.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('modules.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
        ];
        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }
        $news->update($data);
        return redirect()->route('news.index')->with('success', 'Berita berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Tampilkan semua berita untuk user (tanpa tombol admin).
     */
    public function all(Request $request)
    {
        $query = News::orderByDesc('published_at');
        if ($request->has('q') && $request->q) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        $news = $query->get();
        return view('modules.news.all', compact('news'));
    }

    /**
     * Tampilkan detail berita untuk user/pengunjung (tanpa login).
     */
    public function publicShow($id)
    {
        $news = News::findOrFail($id);
        return view('modules.news.public_show', compact('news'));
    }
}
