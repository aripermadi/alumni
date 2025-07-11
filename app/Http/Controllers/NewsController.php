<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
            'image' => 'nullable|image|max:5120',
            'category_id' => 'nullable|exists:categories,id',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $category = $request->category_id ?? 'uncategorized';
            $folder = 'news/' . $category;
            if ($file->getSize() > 2048 * 1024) {
                $img = Image::make($file)->resize(800, 600, function ($c) { $c->aspectRatio(); $c->upsize(); })->encode('jpg', 80);
                $filename = $folder . '/' . uniqid() . '.jpg';
                \Storage::disk('public')->put($filename, $img);
                $imagePath = $filename;
            } else {
                $imagePath = $file->store($folder, 'public');
            }
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
            'image' => 'nullable|image|max:5120',
            'category_id' => 'nullable|exists:categories,id',
        ]);
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'published_at' => $request->published_at,
        ];
        if ($request->hasFile('image')) {
            if ($news->image) {
                \Storage::disk('public')->delete($news->image);
            }
            $file = $request->file('image');
            $category = $request->category_id ?? ($news->category_id ?? 'uncategorized');
            $folder = 'news/' . $category;
            if ($file->getSize() > 2048 * 1024) {
                $img = Image::make($file)->resize(800, 600, function ($c) { $c->aspectRatio(); $c->upsize(); })->encode('jpg', 80);
                $filename = $folder . '/' . uniqid() . '.jpg';
                \Storage::disk('public')->put($filename, $img);
                $data['image'] = $filename;
            } else {
                $data['image'] = $file->store($folder, 'public');
            }
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

    public function ajaxAll(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = 6;
        $query = News::orderByDesc('published_at');
        if ($request->has('q') && $request->q) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        $news = $query->paginate($perPage, ['*'], 'page', $page);
        $html = view('modules.news._news_grid', ['news' => $news])->render();
        return response()->json([
            'news' => $html,
            'hasMore' => $news->hasMorePages()
        ]);
    }
}
