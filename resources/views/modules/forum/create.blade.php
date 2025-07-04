@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="fw-bold text-center mb-4">Buat Topik Diskusi</h2>
                    <form action="{{ route('forum.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Topik</label>
                            <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id }}" {{ old('category_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Gambar/Video (opsional)</label>
                            <div id="drop-area-create" class="border rounded-3 p-4 text-center" style="cursor:pointer; background:#f8f9fa;">
                                <input type="file" name="media" id="media-create" accept="image/*,video/*" style="display:none;">
                                <div id="drop-message-create">Drag & drop file di sini atau klik untuk pilih file</div>
                                <img id="preview-image-create" src="#" alt="Preview" style="max-width:220px;max-height:160px;display:none;" class="mt-2 rounded">
                                <video id="preview-video-create" controls style="max-width:220px;max-height:160px;display:none;" class="mt-2 rounded"></video>
                                <button type="button" class="btn btn-sm btn-danger mt-2" id="remove-media-btn-create" style="display:none;">Hapus File</button>
                            </div>
                            @error('media')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(Auth::user() && Auth::user()->role === 'admin')
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="sticky" id="sticky" value="1" {{ old('sticky') ? 'checked' : '' }}>
                            <label class="form-check-label" for="sticky">
                                Pin/Sticky Topik (tampil di atas)
                            </label>
                        </div>
                        @endif
                        <div class="mb-4">
                            <label for="isi" class="form-label">Isi Topik</label>
                            <textarea name="isi" id="isi" rows="6" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('forum.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="fas fa-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2 shadow-sm">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const dropAreaCreate = document.getElementById('drop-area-create');
const inputCreate = document.getElementById('media-create');
const previewImgCreate = document.getElementById('preview-image-create');
const previewVidCreate = document.getElementById('preview-video-create');
const removeBtnCreate = document.getElementById('remove-media-btn-create');
const dropMsgCreate = document.getElementById('drop-message-create');

dropAreaCreate.addEventListener('click', function(e) {
    if (e.target.tagName !== 'INPUT') inputCreate.click();
});
dropMsgCreate.addEventListener('click', function() {
    inputCreate.click();
});
dropAreaCreate.addEventListener('dragover', e => {
    e.preventDefault();
    dropAreaCreate.classList.add('border-primary');
});
dropAreaCreate.addEventListener('dragleave', e => {
    e.preventDefault();
    dropAreaCreate.classList.remove('border-primary');
});
dropAreaCreate.addEventListener('drop', e => {
    e.preventDefault();
    dropAreaCreate.classList.remove('border-primary');
    if (e.dataTransfer.files.length) {
        inputCreate.files = e.dataTransfer.files;
        handleFileCreate(inputCreate.files[0]);
    }
});
inputCreate.addEventListener('change', () => {
    if (inputCreate.files.length) handleFileCreate(inputCreate.files[0]);
});
removeBtnCreate.addEventListener('click', () => {
    inputCreate.value = '';
    previewImgCreate.style.display = 'none';
    previewVidCreate.style.display = 'none';
    removeBtnCreate.style.display = 'none';
    dropMsgCreate.style.display = 'block';
});
function handleFileCreate(file) {
    dropMsgCreate.style.display = 'none';
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
            previewImgCreate.src = e.target.result;
            previewImgCreate.style.display = 'block';
            previewVidCreate.style.display = 'none';
            removeBtnCreate.style.display = 'inline-block';
        };
        reader.readAsDataURL(file);
    } else if (file.type.startsWith('video/')) {
        const url = URL.createObjectURL(file);
        previewVidCreate.src = url;
        previewVidCreate.style.display = 'block';
        previewImgCreate.style.display = 'none';
        removeBtnCreate.style.display = 'inline-block';
    }
}
</script>
@endpush 