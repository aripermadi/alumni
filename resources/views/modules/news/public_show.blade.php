@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4 shadow-sm border-0" style="border-radius: 1.2rem;">
        @if($news->image)
            <img src="{{ asset('storage/'.$news->image) }}" class="card-img-top" alt="Gambar Berita" style="max-height:300px; object-fit:cover; border-top-left-radius:1.2rem; border-top-right-radius:1.2rem;">
        @endif
        <div class="card-body">
            <h3 class="card-title fw-bold">{{ $news->title }}</h3>
            <p class="text-muted small mb-1"><i class="fas fa-calendar-alt me-1"></i> {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d-m-Y') : '-' }}</p>
            <div class="card-text mb-3">{!! nl2br(e($news->content)) !!}</div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card-title {
    font-weight: 700;
    font-size: 2rem;
}
.card-text {
    font-size: 1.1rem;
}
</style>
@endpush 