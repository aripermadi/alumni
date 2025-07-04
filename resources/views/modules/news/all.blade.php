@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Semua Berita</h3>
    </div>
    <form method="GET" action="{{ route('news.all') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari berita..." value="{{ request('q') }}">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
        </div>
    </form>
    <div class="row g-4">
        @forelse($news as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0 news-card">
                    @if($item->image)
                        <img src="{{ asset('storage/'.$item->image) }}" class="card-img-top" alt="Gambar Berita" style="height:180px; object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">{{ $item->title }}</h5>
                        <div class="mb-2 text-muted small">
                            <i class="fas fa-calendar-alt me-1"></i> {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d-m-Y') : '-' }}
                        </div>
                        <div class="mb-2 card-text small">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 80) }}</div>
                        <div class="mt-auto">
                            <a href="{{ route('news.public.show', $item->id) }}" class="btn btn-sm btn-info w-100"><i class="fas fa-eye"></i> Baca</a>
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
.btn-info {
    min-width: 80px;
}
.news-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.news-card:hover {
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