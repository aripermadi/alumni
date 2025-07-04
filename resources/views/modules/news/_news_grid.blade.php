@foreach($news as $item)
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
@endforeach 