@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4 shadow-sm border-0" style="border-radius: 1.2rem;">
        <!-- Main Image -->
        @if($event->main_image)
            <img src="{{ asset('storage/'.$event->main_image) }}" class="card-img-top img-fluid" style="max-width:100%; height:auto; object-fit:contain; background:#f8f9fa; border-radius:1.2rem 1.2rem 0 0;">
        @endif
        
        <div class="card-body">
            <h3 class="card-title fw-bold">{{ $event->title }}</h3>
            <p class="text-muted small mb-1"><i class="fas fa-calendar-alt me-1"></i> {{ $event->event_date ? \Carbon\Carbon::parse($event->event_date)->format('d-m-Y') : '-' }}</p>
            <p class="text-muted small mb-1"><i class="fas fa-map-marker-alt me-1"></i> {{ $event->location }}</p>
            <div class="card-text mb-3">{!! nl2br(e($event->description)) !!}</div>
            
            <!-- Event Images Gallery -->
            @if($event->images->count() > 0)
            <div class="mt-4">
                <h5 class="fw-bold">Galeri Event</h5>
                <div class="row">
                    @foreach($event->images as $image)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm">
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
            
            <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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