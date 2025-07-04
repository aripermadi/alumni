@extends('layouts.app')

@section('content')
<div class="container mt-4">
    
    <form method="GET" action="{{ route('alumni.index') }}" class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-center">Data Alumni</h3>
        </div>
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari nama alumni..." value="{{ request('q') }}">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
        </div>
    </form>
    <div class="row g-4">
        @forelse($alumni as $item)
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card h-100 shadow-sm border-0 alumni-card">
                    <div class="d-flex justify-content-center align-items-center pt-4" style="min-height:100px;">
                        <img src="{{ $item->foto ? asset('storage/'.$item->foto) : 'https://ui-avatars.com/api/?name='.urlencode($item->user->name) }}" class="rounded-circle mb-2" alt="Foto Alumni" style="width:80px; height:80px; object-fit:cover; border:4px solid #e9ecef;">
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <h5 class="card-title mb-1">{{ $item->user->name }}</h5>
                        <div class="text-muted small mb-2">Angkatan: {{ $item->angkatan ?? '-' }}</div>
                        <div class="mb-2">Jurusan: <span class="fw-semibold">{{ $item->jurusan ?? '-' }}</span></div>
                        <div class="mb-2"><i class="fas fa-briefcase me-1"></i> {{ $item->pekerjaan ?? '-' }}</div>
                        <a href="{{ route('alumni.show', $item->id) }}" class="btn btn-info btn-sm w-100 mt-auto"><i class="fas fa-user"></i> Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">Belum ada data alumni.</div>
        @endforelse
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $alumni->withQueryString()->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
.alumni-card {
    border-radius: 1.2rem;
    transition: box-shadow 0.2s, transform 0.2s;
}
.alumni-card:hover {
    box-shadow: 0 8px 32px rgba(13,110,253,0.13);
    transform: translateY(-4px) scale(1.03);
}
.card-title {
    font-weight: 600;
}
.alumni-card .d-flex.justify-content-center.align-items-center {
    min-height: 120px;
}
</style>
@endpush 