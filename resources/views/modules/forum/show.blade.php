@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 mb-4 position-relative">
                @if($forum->sticky)
                    <div class="position-absolute top-0 end-0 m-2"><span class="badge bg-primary"><i class="fas fa-thumbtack"></i> Sticky</span></div>
                @endif
                
                <div class="card-body p-4">
                    <div class="mb-2">
                        <span class="badge bg-info text-dark me-1">{{ $forum->category->nama ?? '-' }}</span>
                        <span class="text-muted small">Oleh: {{ $forum->user->name }} &bull; {{ $forum->created_at->diffForHumans() }}</span>
                    </div>
                    <h3 class="fw-bold mb-2">{{ $forum->judul }}</h3>
                    <div class="mb-3">{!! nl2br(e($forum->isi)) !!}</div>
                    @if($forum->image)
                    <img src="{{ asset('storage/'.$forum->image) }}" class="card-img-top" style="object-fit:cover;max-height:260px;cursor:pointer;" onclick="showImageModal('{{ asset('storage/'.$forum->image) }}')">
                @endif
                @if($forum->video)
                    <video src="{{ asset('storage/'.$forum->video) }}" controls class="card-img-top mt-2" style="object-fit:cover;max-height:260px;width:100%;border-radius:0.7rem;"></video>
                @endif
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
                                <img src="{{ asset('storage/'.$reply->image) }}" class="rounded mb-2" style="max-width:180px;max-height:120px;object-fit:cover;cursor:pointer;" onclick="showImageModal('{{ asset('storage/'.$reply->image) }}')">
                            @endif
                            @if($reply->video)
                                <video src="{{ asset('storage/'.$reply->video) }}" controls style="max-width:220px;max-height:160px;" class="mt-2 rounded"></video>
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
                                        @if($reply->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/'.$reply->image) }}" style="max-width:120px;max-height:80px;" class="rounded mb-1">
                                            <button type="submit" name="delete_image" value="1" class="btn btn-sm btn-danger">Hapus Gambar</button>
                                        </div>
                                        @endif
                                        @if($reply->video)
                                        <div class="mb-2">
                                            <video src="{{ asset('storage/'.$reply->video) }}" controls style="max-width:120px;max-height:80px;" class="rounded mb-1"></video>
                                            <button type="submit" name="delete_video" value="1" class="btn btn-sm btn-danger">Hapus Video</button>
                                        </div>
                                        @endif
                                        <div class="mb-2">
                                            <label class="form-label">Upload Gambar/Video</label>
                                            <div id="drop-area-edit-{{ $reply->id }}" class="drop-area-edit border rounded-3 p-4 text-center" style="cursor:pointer; background:#f8f9fa;">
                                                <input type="file" name="media" id="media-edit-{{ $reply->id }}" class="media-edit" accept="image/*,video/*" style="display:none;">
                                                <div id="drop-message-edit-{{ $reply->id }}" class="drop-message-edit">Drag & drop file di sini atau klik untuk pilih file</div>
                                                <img id="preview-image-edit-{{ $reply->id }}" src="#" alt="Preview" style="max-width:220px;max-height:160px;display:none;" class="mt-2 rounded">
                                                <video id="preview-video-edit-{{ $reply->id }}" controls style="max-width:220px;max-height:160px;display:none;" class="mt-2 rounded"></video>
                                                <button type="button" class="btn btn-sm btn-danger mt-2" id="remove-media-btn-edit-{{ $reply->id }}">Hapus File</button>
                                            </div>
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
                            <label class="form-label">Upload Gambar/Video</label>
                            <div id="drop-area" class="border rounded-3 p-4 text-center" style="cursor:pointer; background:#f8f9fa;">
                                <input type="file" name="media" id="media" accept="image/*,video/*" style="display:none;">
                                <div id="drop-message">Drag & drop file di sini atau klik untuk pilih file</div>
                                <img id="preview-image" src="#" alt="Preview" style="max-width:220px;max-height:160px;display:none;" class="mt-2 rounded">
                                <video id="preview-video" controls style="max-width:220px;max-height:160px;display:none;" class="mt-2 rounded"></video>
                                <button type="button" class="btn btn-sm btn-danger mt-2" id="remove-media-btn" style="display:none;">Hapus File</button>
                            </div>
                            @error('media')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
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

{{-- Modal Preview Gambar --}}
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-labelledby="imagePreviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body text-center p-0">
        <img id="modalImagePreview" src="#" alt="Preview" style="max-width:100%;max-height:80vh;" class="rounded shadow">
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
    function showImageModal(src) {
        var modal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
        document.getElementById('modalImagePreview').src = src;
        modal.show();
    }
    function previewVideo(event, previewId, removeBtnId = null) {
        const input = event.target;
        const preview = document.getElementById(previewId);
        const removeBtn = removeBtnId ? document.getElementById(removeBtnId) : null;
        if (input.files && input.files[0]) {
            const url = URL.createObjectURL(input.files[0]);
            preview.src = url;
            preview.style.display = 'block';
            if (removeBtn) removeBtn.style.display = 'inline-block';
        } else {
            preview.src = '';
            preview.style.display = 'none';
            if (removeBtn) removeBtn.style.display = 'none';
        }
    }
    function removeVideo(inputId, previewId, removeBtnId, btn = null) {
        let input;
        if(inputId) input = document.getElementById(inputId);
        else if(btn) input = btn.previousElementSibling.previousElementSibling; // fallback untuk edit form
        const preview = document.getElementById(previewId);
        const removeBtn = document.getElementById(removeBtnId);
        if (input) input.value = '';
        preview.src = '';
        preview.style.display = 'none';
        if (removeBtn) removeBtn.style.display = 'none';
    }
    const dropArea = document.getElementById('drop-area');
    const input = document.getElementById('media');
    const previewImg = document.getElementById('preview-image');
    const previewVid = document.getElementById('preview-video');
    const removeBtn = document.getElementById('remove-media-btn');
    const dropMsg = document.getElementById('drop-message');

    dropArea.addEventListener('click', () => input.click());
    dropArea.addEventListener('dragover', e => {
        e.preventDefault();
        dropArea.classList.add('border-primary');
    });
    dropArea.addEventListener('dragleave', e => {
        e.preventDefault();
        dropArea.classList.remove('border-primary');
    });
    dropArea.addEventListener('drop', e => {
        e.preventDefault();
        dropArea.classList.remove('border-primary');
        if (e.dataTransfer.files.length) {
            input.files = e.dataTransfer.files;
            handleFile(input.files[0]);
        }
    });
    input.addEventListener('change', () => {
        if (input.files.length) handleFile(input.files[0]);
    });
    removeBtn.addEventListener('click', () => {
        input.value = '';
        previewImg.style.display = 'none';
        previewVid.style.display = 'none';
        removeBtn.style.display = 'none';
        dropMsg.style.display = 'block';
    });

    function handleFile(file) {
        dropMsg.style.display = 'none';
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                previewVid.style.display = 'none';
                removeBtn.style.display = 'inline-block';
            };
            reader.readAsDataURL(file);
        } else if (file.type.startsWith('video/')) {
            const url = URL.createObjectURL(file);
            previewVid.src = url;
            previewVid.style.display = 'block';
            previewImg.style.display = 'none';
            removeBtn.style.display = 'inline-block';
        }
    }

    // Drag & drop untuk form edit reply (global, tidak di dalam loop)
    document.querySelectorAll('.drop-area-edit').forEach(function(dropArea) {
        const input = dropArea.querySelector('.media-edit');
        const previewImg = dropArea.querySelector('img');
        const previewVid = dropArea.querySelector('video');
        const removeBtn = dropArea.querySelector('button');
        const dropMsg = dropArea.querySelector('.drop-message-edit');

        dropArea.addEventListener('click', function(e) {
            if (e.target.tagName !== 'INPUT') input.click();
        });
        dropMsg.addEventListener('click', function() {
            input.click();
        });
        dropArea.addEventListener('dragover', e => {
            e.preventDefault();
            dropArea.classList.add('border-primary');
        });
        dropArea.addEventListener('dragleave', e => {
            e.preventDefault();
            dropArea.classList.remove('border-primary');
        });
        dropArea.addEventListener('drop', e => {
            e.preventDefault();
            dropArea.classList.remove('border-primary');
            if (e.dataTransfer.files.length) {
                input.files = e.dataTransfer.files;
                handleFile(input.files[0]);
            }
        });
        input.addEventListener('change', () => {
            if (input.files.length) handleFile(input.files[0]);
        });
        removeBtn.addEventListener('click', () => {
            input.value = '';
            previewImg.style.display = 'none';
            previewVid.style.display = 'none';
            removeBtn.style.display = 'none';
            dropMsg.style.display = 'block';
        });
        function handleFile(file) {
            dropMsg.style.display = 'none';
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                    previewVid.style.display = 'none';
                    removeBtn.style.display = 'inline-block';
                };
                reader.readAsDataURL(file);
            } else if (file.type.startsWith('video/')) {
                const url = URL.createObjectURL(file);
                previewVid.src = url;
                previewVid.style.display = 'block';
                previewImg.style.display = 'none';
                removeBtn.style.display = 'inline-block';
            }
        }
    });
</script>
@endpush 