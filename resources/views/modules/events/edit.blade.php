@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Event</h3>
    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="5" required>{{ $event->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="event_date" class="form-label">Tanggal Event</label>
            <input type="date" class="form-control" id="event_date" name="event_date" value="{{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') : '' }}" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}" required>
        </div>

        <!-- Existing Images -->
        @if($event->images->count() > 0)
        <div class="mb-3">
            <label class="form-label">Gambar Event Saat Ini</label>
            <div class="row">
                @foreach($event->images as $image)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ asset('storage/'.$image->image_path) }}" class="card-img-top" alt="Event Image" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            @if($image->caption)
                                <p class="card-text">{{ $image->caption }}</p>
                            @endif
                            <button type="button" class="btn btn-danger btn-sm delete-image" data-event-id="{{ $event->id }}" data-image-id="{{ $image->id }}">
                                Hapus Gambar
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Add New Images -->
        <div class="mb-3">
            <label class="form-label">Tambah Gambar Baru</label>
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
            @if($event->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/'.$event->image) }}" alt="Gambar Event" style="max-width:150px;">
                </div>
            @endif
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
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

    // Delete existing image
    document.querySelectorAll('.delete-image').forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                const eventId = this.dataset.eventId;
                const imageId = this.dataset.imageId;
                
                fetch(`/events/${eventId}/images/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest('.col-md-4').remove();
                    } else {
                        alert('Gagal menghapus gambar');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menghapus gambar');
                });
            }
        });
    });
});
</script>
@endsection 