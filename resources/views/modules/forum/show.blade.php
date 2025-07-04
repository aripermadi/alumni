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
                                @auth
                                    @if(auth()->id() === $reply->user_id)
                                        <button type="button" class="btn btn-sm btn-link ms-2 p-0" onclick="showEditForm({{ $reply->id }})">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    @endif
                                @endauth
                            </div>
                            @if($reply->image)
                                <img src="{{ asset('storage/'.$reply->image) }}" class="rounded mb-2" style="max-width:180px;max-height:120px;object-fit:cover;">
                            @endif
                            <div id="reply-content-{{ $reply->id }}">{!! nl2br(e($reply->isi)) !!}</div>
                            @auth
                                @if(auth()->id() === $reply->user_id)
                                    <form id="edit-form-{{ $reply->id }}" action="{{ route('forum.reply.update', [$forum->id, $reply->id]) }}" method="POST" class="mb-2" style="display:none;" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-2">
                                            <textarea name="isi" class="form-control" rows="3" required>{{ $reply->isi }}</textarea>
                                        </div>
                                        <div class="mb-2">
                                            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event, 'preview-edit-image-{{ $reply->id }}', 'remove-edit-image-btn-{{ $reply->id }}')">
                                            <img id="preview-edit-image-{{ $reply->id }}" src="#" alt="Preview" class="mt-2 rounded" style="max-width:180px;max-height:120px;display:none;object-fit:cover;">
                                            <button type="button" class="btn btn-sm btn-danger mt-2" id="remove-edit-image-btn-{{ $reply->id }}" style="display:none;" onclick="removeImage('', 'preview-edit-image-{{ $reply->id }}', 'remove-edit-image-btn-{{ $reply->id }}', this)">Hapus Gambar</button>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        <button type="button" class="btn btn-secondary btn-sm" onclick="hideEditForm({{ $reply->id }})">Batal</button>
                                    </form>
                                @endif
                            @endauth
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
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewImage(event, 'preview-image', 'remove-image-btn')">
                            <img id="preview-image" src="#" alt="Preview" class="mt-2 rounded" style="max-width:180px;max-height:120px;display:none;object-fit:cover;">
                            <button type="button" class="btn btn-sm btn-danger mt-2" id="remove-image-btn" style="display:none;" onclick="removeImage('image', 'preview-image', 'remove-image-btn')">Hapus Gambar</button>
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

@push('scripts')
<script>
    function showEditForm(id) {
        document.getElementById('edit-form-' + id).style.display = 'block';
        document.getElementById('reply-content-' + id).style.display = 'none';
    }
    function hideEditForm(id) {
        document.getElementById('edit-form-' + id).style.display = 'none';
        document.getElementById('reply-content-' + id).style.display = 'block';
    }
    function previewImage(event, previewId, removeBtnId = null) {
        const input = event.target;
        const preview = document.getElementById(previewId);
        const removeBtn = removeBtnId ? document.getElementById(removeBtnId) : document.getElementById('remove-image-btn');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (removeBtn) removeBtn.style.display = 'inline-block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
            if (removeBtn) removeBtn.style.display = 'none';
        }
    }
    function removeImage(inputId, previewId, removeBtnId, btn = null) {
        let input;
        if(inputId) input = document.getElementById(inputId);
        else if(btn) input = btn.previousElementSibling.previousElementSibling; // fallback untuk edit form
        const preview = document.getElementById(previewId);
        const removeBtn = document.getElementById(removeBtnId);
        if (input) input.value = '';
        preview.src = '#';
        preview.style.display = 'none';
        if (removeBtn) removeBtn.style.display = 'none';
    }
</script>
@endpush 