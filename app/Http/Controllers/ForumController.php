<?php
namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\ForumReply;
use App\Models\ForumCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $kategori = ForumCategory::all();
        $query = Forum::with('user', 'category');
        if ($request->has('kategori') && $request->kategori) {
            $query->where('category_id', $request->kategori);
        }
        $forumsSticky = (clone $query)->where('sticky', true)->latest()->get();
        $forums = $query->where('sticky', false)->latest()->paginate(10);
        return view('modules.forum.index', compact('forums', 'forumsSticky', 'kategori'));
    }

    public function show($id)
    {
        $forum = Forum::with(['user', 'replies.user'])->findOrFail($id);
        return view('modules.forum.show', compact('forum'));
    }

    public function create()
    {
        $kategori = ForumCategory::all();
        return view('modules.forum.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'category_id' => 'required|exists:forum_categories,id',
            'image' => 'nullable|image|max:2048',
            'sticky' => 'nullable|boolean',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('forum', 'public');
        }
        $forum = Forum::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'category_id' => $request->category_id,
            'sticky' => $request->sticky ? true : false,
            'image' => $imagePath,
        ]);
        return redirect()->route('forum.show', $forum->id)->with('success', 'Topik berhasil dibuat.');
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('forum_replies', 'public');
        }
        ForumReply::create([
            'forum_id' => $id,
            'user_id' => Auth::id(),
            'isi' => $request->isi,
            'image' => $imagePath,
        ]);
        return redirect()->route('forum.show', $id)->with('success', 'Balasan berhasil ditambahkan.');
    }
} 