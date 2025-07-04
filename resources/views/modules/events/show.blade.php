@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        @if($event->image)
            <img src="{{ asset('storage/'.$event->image) }}" class="card-img-top" alt="Gambar Event" style="max-height:300px; object-fit:cover;">
        @endif
        <div class="card-body">
            <h3 class="card-title">{{ $event->title }}</h3>
            <p class="text-muted small mb-1">Tanggal: {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M Y') : '-' }}</p>
            <p class="text-muted small mb-1">Lokasi: {{ $event->location }}</p>
            @php
            if (!function_exists('linkify')) {
                function linkify($text) {
                    $pattern = '/(https?:\/\/[\w\-\.\/?&=%#]+[\w\-\/?&=%#])/i';
                    return preg_replace($pattern, '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $text);
                }
            }
            @endphp
            <div class="card-text">{!! nl2br(linkify(e($event->description))) !!}</div>
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>
@endsection 