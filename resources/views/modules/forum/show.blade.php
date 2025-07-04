@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 mb-4 position-relative">
                @if($forum->sticky)
                    <div class="position-absolute top-0 end-0 m-2"><span class="badge bg-primary"><i class="fas fa-thumbtack"></i> Sticky</span></div>
                @endif
                @if($forum->image)
                    <img src="{{ asset('storage/'.$forum->image) }}" class="card-img-top" style="object-fit:cover;max-height:260px;">
                @endif
                <div class="card-body p-4">
                    <div class="mb-2">
                        <span class="badge bg-info text-dark me-1">{{ $forum->category->nama ?? '-' }}</span>
                        <span class="text-muted small">Oleh: {{ $forum->user->name }} &bull; {{ $forum->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="fw-bold mb-2">{{ $forum->judul }}</h3>
                    <div class="mb-3">{!! nl2br(e($forum->isi)) !!}</div>
                </div>
            </div>
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Balasan</h5>
                    @forelse($forum->replies as $reply)
                        <div class="mb-4 pb-3 border-bottom">
                            <div class="d-flex align-items-center mb-1">
                                <span class="fw-semibold">{{ $reply->user->name }}</span>
                                <span class="text-muted small ms-2">{{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            @if($reply->image)
                                <img src="{{ asset('storage/'.$reply->image) }}" class="rounded mb-2" style="max-width:180px;max-height:120px;object-fit:cover;">
                            @endif
                            <div>{!! nl2br(e($reply->isi)) !!}</div>
                        </div>
                    @empty
                        <div class="text-muted">Belum ada balasan.</div>
                    @endforelse
                    @auth
                    <form action="{{ route('forum.reply', $forum->id) }}" method="POST" class="mt-4" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="isi" class="form-label">Tulis Balasan</label>
                            <textarea name="isi" id="isi" rows="4" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar (opsional)</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                                <i class="fas fa-paper-plane me-1"></i> Kirim
                            </button>
                        </div>
                    </form>
                    @endauth
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <a href="{{ route('forum.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                    <i class="fas fa-arrow-left me-1"></i> Kembali ke Forum
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 