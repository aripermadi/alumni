@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <!-- Main Image -->
        @if($event->main_image)
            <img src="{{ asset('storage/'.$event->main_image) }}" class="card-img-top img-fluid" style="max-width:100%; height:auto; object-fit:contain; background:#f8f9fa; border-radius:1.2rem 1.2rem 0 0;">
        @endif
        
        <div class="card-body">
            <h3 class="card-title">{{ $event->title }}</h3>
            <p class="text-muted small mb-1">Tanggal: {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d M Y') : '-' }}</p>
            <p class="text-muted small mb-1">Lokasi: {{ $event->location }}</p>
            @php
            if (!function_exists('linkify')) {
                function linkify($text) {
                    // Deteksi http(s)://, www., dan wa.me
                    $pattern = '/((https?:\/\/|www\.)[^\s<]+)/i';
                    $text = preg_replace_callback($pattern, function($matches) {
                        $url = $matches[0];
                        $href = preg_match('/^https?:\/\//i', $url) ? $url : 'http://' . $url;
                        return '<a href="' . $href . '" target="_blank" rel="noopener noreferrer">' . $url . '</a>';
                    }, $text);
                    return $text;
                }
            }
            @endphp
            <div class="card-text">{!! nl2br(linkify(e($event->description))) !!}</div>
            
            <!-- Event Images Gallery -->
            @if($event->images->count() > 0)
            <div class="mt-4">
                <h5>Galeri Event</h5>
                <div class="row">
                    @foreach($event->images as $image)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('storage/'.$image->image_path) }}" 
                                 class="card-img-top event-gallery-image img-fluid" 
                                 alt="Event Image" 
                                 style="height: 200px; object-fit: contain; background:#f8f9fa; cursor: pointer;"
                                 data-bs-toggle="modal" 
                                 data-bs-target="#imageModal"
                                 data-image="{{ asset('storage/'.$image->image_path) }}"
                                 data-caption="{{ $image->caption }}">
                            @if($image->caption)
                            <div class="card-body">
                                <p class="card-text small">{{ $image->caption }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            <button type="button" class="btn btn-secondary mt-3" onclick="window.history.back()">Kembali</button>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Gambar Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Event Image" class="img-fluid">
                <p id="modalCaption" class="mt-2"></p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle gallery image clicks
    document.querySelectorAll('.event-gallery-image').forEach(image => {
        image.addEventListener('click', function() {
            const modalImage = document.getElementById('modalImage');
            const modalCaption = document.getElementById('modalCaption');
            
            modalImage.src = this.dataset.image;
            modalCaption.textContent = this.dataset.caption || '';
        });
    });
});
</script>
@endsection 