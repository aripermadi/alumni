@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Berita</h3>
    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Isi Berita</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="published_at" class="form-label">Tanggal Publish</label>
            <input type="date" class="form-control" id="published_at" name="published_at">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar (opsional)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('news.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection 