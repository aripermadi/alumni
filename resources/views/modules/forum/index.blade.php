@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h2 class="fw-bold mb-0">Forum Diskusi</h2>
        @auth
        <a href="{{ route('forum.create') }}" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center fw-semibold shadow-sm">
            <i class="fas fa-plus me-2"></i> Buat Topik
        </a>
        @endauth
    </div>
    <form method="GET" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <select name="kategori" class="form-select rounded-pill">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary rounded-pill px-4" type="submit"><i class="fas fa-filter me-1"></i> Filter</button>
            </div>
        </div>
    </form>
    @if(isset($forumsSticky) && $forumsSticky->count())
    <div class="mb-4">
        <h6 class="fw-bold text-primary mb-3"><i class="fas fa-thumbtack me-1"></i> Topik Penting</h6>
        <div class="row g-4">
            @foreach($forumsSticky as $forum)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow border-primary border-2 rounded-4 position-relative">
                    <div class="position-absolute top-0 end-0 m-2"><span class="badge bg-primary"><i class="fas fa-thumbtack"></i> Sticky</span></div>
                    @if($forum->image)
                        <img src="{{ asset('storage/'.$forum->image) }}" class="card-img-top" style="object-fit:cover;max-height:180px;">
                    @endif
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div class="mb-2">
                            <h5 class="fw-bold mb-2"><a href="{{ route('forum.show', $forum->id) }}" class="text-decoration-none text-dark">{{ $forum->judul }}</a></h5>
                            <div class="mb-1">
                                <span class="me-2"><i class="fas fa-comments"></i> {{ $forum->replies_count }} Komentar</span>
                            </div>
                            <div class="mb-2">
                                <span class="badge bg-info text-dark me-1">{{ $forum->category->nama ?? '-' }}</span>
                                <span class="text-muted small">Oleh: {{ $forum->user->name }} &bull; {{ $forum->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-truncate" style="max-width:100%">{{ Str::limit(strip_tags($forum->isi), 100) }}</div>
                        </div>
                        <a href="{{ route('forum.show', $forum->id) }}" class="btn btn-outline-primary btn-sm rounded-pill mt-3 align-self-end">Lihat Diskusi</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    <div class="row g-4">
        @forelse($forums as $forum)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 position-relative">
                @if($forum->sticky)
                    <div class="position-absolute top-0 end-0 m-2"><span class="badge bg-primary"><i class="fas fa-thumbtack"></i> Sticky</span></div>
                @endif
                @if($forum->image)
                    <img src="{{ asset('storage/'.$forum->image) }}" class="card-img-top" style="object-fit:cover;max-height:180px;">
                @endif
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    <div class="mb-2">
                        <h5 class="fw-bold mb-2"><a href="{{ route('forum.show', $forum->id) }}" class="text-decoration-none text-dark">{{ $forum->judul }}</a></h5>
                        <div class="mb-1">
                            <span class="me-2"><i class="fas fa-comments"></i> {{ $forum->replies_count }} Komentar</span>
                        </div>
                        <div class="mb-2">
                            <span class="badge bg-info text-dark me-1">{{ $forum->category->nama ?? '-' }}</span>
                            <span class="text-muted small">Oleh: {{ $forum->user->name }} &bull; {{ $forum->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-truncate" style="max-width:100%">{{ Str::limit(strip_tags($forum->isi), 100) }}</div>
                    </div>
                    <a href="{{ route('forum.show', $forum->id) }}" class="btn btn-outline-primary btn-sm rounded-pill mt-3 align-self-end">Lihat Diskusi</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-5">
            <i class="fas fa-comments fa-2x mb-3"></i><br>
            Belum ada topik diskusi.
        </div>
        @endforelse
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $forums->links() }}
    </div>
</div>
@endsection 