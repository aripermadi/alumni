@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        @if($news->image)
            <img src="{{ asset('storage/'.$news->image) }}" class="card-img-top" alt="Gambar Berita" style="max-height:300px; object-fit:cover;">
        @endif
        <div class="card-body">
            <h3 class="card-title">{{ $news->title }}</h3>
            <p class="text-muted small">{{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d M Y') : '-' }}</p>
            <div class="card-text">{!! nl2br(e($news->content)) !!}</div>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
@endsection 