@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Event</h3>
        <a href="{{ route('events.create') }}" class="btn btn-primary">Tambah Event</a>
    </div>
    <form method="GET" action="{{ route('events.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari event..." value="{{ request('q') }}">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
        </div>
    </form>
    <div class="row g-4">
        @forelse($events as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 event-card">
                    @if($item->main_image)
                        <img src="{{ asset('storage/'.$item->main_image) }}" class="card-img-top" alt="Gambar Event" style="height:180px; object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">{{ $item->title }}</h5>
                        <div class="mb-2 text-muted small">
                            <i class="fas fa-calendar-alt me-1"></i> {{ $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('d-m-Y') : '-' }}<br>
                            <i class="fas fa-map-marker-alt me-1"></i> {{ $item->location }}
                        </div>
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('events.show', $item->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i> Detail</a>
                            <a href="{{ route('events.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('events.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">Belum ada event.</div>
        @endforelse
    </div>
</div>
@endsection

@push('styles')
<style>
.card-title {
    font-weight: 600;
}
.card-img-top {
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}
.card {
    border-radius: 1rem;
    transition: box-shadow 0.2s;
}
.card:hover {
    box-shadow: 0 6px 24px rgba(13,110,253,0.12);
}
.btn-warning, .btn-danger, .btn-info {
    min-width: 80px;
}
.event-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.event-card:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 8px 32px rgba(13,110,253,0.13);
}
.input-group input[type="text"] {
    border-radius: 1rem 0 0 1rem;
}
.input-group .btn {
    border-radius: 0 1rem 1rem 0;
}
</style>
@endpush 