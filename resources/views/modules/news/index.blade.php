@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Berita</h3>
        <a href="{{ route('news.create') }}" class="btn btn-primary">Tambah Berita</a>
    </div>
    <div class="row g-4">
        @forelse($news as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" class="card-img-top" alt="Gambar Berita" style="height:180px; object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">{{ $item->title }}</h5>
                        <div class="mb-2 text-muted small">
                            <i class="fas fa-calendar-alt me-1"></i> {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d-m-Y') : '-' }}
                        </div>
                        <div class="mb-2 card-text small">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 80) }}</div>
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('news.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')"><i class="fas fa-trash-alt"></i> Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">Belum ada berita.</div>
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
.btn-warning, .btn-danger {
    min-width: 80px;
}
</style>
@endpush 