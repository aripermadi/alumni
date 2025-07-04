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
        <div class="mb-3">
            <label for="image" class="form-label">Gambar (opsional)</label>
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
@endsection 