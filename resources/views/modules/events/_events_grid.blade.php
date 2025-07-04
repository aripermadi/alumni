@foreach($events as $item)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm border-0 event-card">
            @if($item->image)
                <img src="{{ asset('storage/'.$item->image) }}" class="card-img-top" alt="Gambar Event" style="height:180px; object-fit:cover;">
            @endif
            <div class="card-body d-flex flex-column">
                <h5 class="card-title mb-1">{{ $item->title }}</h5>
                <div class="mb-2 text-muted small">
                    <i class="fas fa-calendar-alt me-1"></i> {{ $item->event_date ? \Carbon\Carbon::parse($item->event_date)->format('d-m-Y') : '-' }}<br>
                    <i class="fas fa-map-marker-alt me-1"></i> {{ $item->location }}
                </div>
                <div class="mt-auto">
                    <a href="{{ route('events.public.show', $item->id) }}" class="btn btn-sm btn-info w-100"><i class="fas fa-eye"></i> Detail</a>
                </div>
            </div>
        </div>
    </div>
@endforeach 