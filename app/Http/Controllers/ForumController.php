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
        $query = Forum::with('user', 'category')->withCount('replies');
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
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm,ogg|max:20480',
            'sticky' => 'nullable|boolean',
        ]);
        $imagePath = null;
        $videoPath = null;
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            if (str_starts_with($file->getMimeType(), 'image/')) {
                $imagePath = $file->store('forum', 'public');
            } elseif (str_starts_with($file->getMimeType(), 'video/')) {
                $videoPath = $file->store('forum_videos', 'public');
            }
        }
        $forum = Forum::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'category_id' => $request->category_id,
            'sticky' => $request->sticky ? true : false,
            'image' => $imagePath,
            'video' => $videoPath,
        ]);
        return redirect()->route('forum.show', $forum->id)->with('success', 'Topik berhasil dibuat.');
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'isi' => 'required|string',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm,ogg|max:20480',
        ]);
        $imagePath = null;
        $videoPath = null;
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            if (str_starts_with($file->getMimeType(), 'image/')) {
                $imagePath = $file->store('forum_replies', 'public');
            } elseif (str_starts_with($file->getMimeType(), 'video/')) {
                $videoPath = $file->store('forum_replies_videos', 'public');
            }
        }
        ForumReply::create([
            'forum_id' => $id,
            'user_id' => Auth::id(),
            'isi' => $request->isi,
            'image' => $imagePath,
            'video' => $videoPath,
        ]);
        return redirect()->route('forum.show', $id)->with('success', 'Balasan berhasil ditambahkan.');
    }

    public function updateReply(Request $request, $forumId, $replyId)
    {
        $reply = ForumReply::findOrFail($replyId);
        if ($reply->user_id !== Auth::id()) {
            abort(403);
        }
        $request->validate([
            'isi' => 'required|string',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,webm,ogg|max:20480',
        ]);
        $reply->isi = $request->isi;
        if ($request->has('delete_image')) {
            $reply->image = null;
        }
        if ($request->has('delete_video')) {
            $reply->video = null;
        }
        if ($request->hasFile('media')) {
            $file = $request->file('media');
            if (str_starts_with($file->getMimeType(), 'image/')) {
                $reply->image = $file->store('forum_replies', 'public');
                $reply->video = null;
            } elseif (str_starts_with($file->getMimeType(), 'video/')) {
                $reply->video = $file->store('forum_replies_videos', 'public');
                $reply->image = null;
            }
        }
        $reply->save();
        return redirect()->route('forum.show', $forumId)->with('success', 'Balasan berhasil diupdate.');
    }
} 