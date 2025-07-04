@if($alumni->count())
    <h4 class="mt-4 mb-3">Angkatan {{ $angkatan }}</h4>
    <div class="row g-4">
        @foreach($alumni as $item)
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
        @endforeach
    </div>
@endif 