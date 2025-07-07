@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Event</h3>
    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="event_date" class="form-label">Tanggal Event</label>
            <input type="date" class="form-control" id="event_date" name="event_date" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        
        <!-- Multiple Images Section -->
        <div class="mb-3">
            <label class="form-label">Gambar Event (Multiple)</label>
            <div id="image-container">
                <div class="image-input-group mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" class="form-control" name="images[]" accept="image/*">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="captions[]" placeholder="Caption (opsional)">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-sm remove-image">Hapus</button>
                        </div>
                    </div>
                    <div class="image-preview mt-2"></div>
                </div>
            </div>
            <button type="button" class="btn btn-success btn-sm" id="add-image">+ Tambah Gambar</button>
        </div>

        <!-- Legacy single image for backward compatibility -->
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Utama (opsional)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageContainer = document.getElementById('image-container');
    const addImageBtn = document.getElementById('add-image');

    // Add new image input
    addImageBtn.addEventListener('click', function() {
        const newGroup = document.createElement('div');
        newGroup.className = 'image-input-group mb-2';
        newGroup.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <input type="file" class="form-control" name="images[]" accept="image/*">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="captions[]" placeholder="Caption (opsional)">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-image">Hapus</button>
                </div>
            </div>
            <div class="image-preview mt-2"></div>
        `;
        imageContainer.appendChild(newGroup);
    });

    // Remove image input
    imageContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-image')) {
            e.target.closest('.image-input-group').remove();
        }
    });

    // Image preview
    imageContainer.addEventListener('change', function(e) {
        if (e.target.type === 'file') {
            const file = e.target.files[0];
            const preview = e.target.closest('.image-input-group').querySelector('.image-preview');
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '';
            }
        }
    });
});
</script>
@endsection 