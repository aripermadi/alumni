@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h2 class="fw-bold mb-0">Semua Lowongan Kerja</h2>
    </div>
    <div class="row g-4">
        @forelse($jobs as $job)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 position-relative">
                <div class="card-body d-flex flex-column justify-content-between p-4">
                    @if($job->logo)
                        <div class="text-center mb-2"><img src="{{ asset('storage/'.$job->logo) }}" alt="Logo" style="max-width:60px;max-height:60px;"></div>
                    @endif
                    <div class="mb-2">
                        <h5 class="fw-bold mb-2">{{ $job->title }}</h5>
                        <div class="mb-1"><i class="fas fa-building me-1"></i> {{ $job->company }}</div>
                        <div class="mb-1"><i class="fas fa-map-marker-alt me-1"></i> {{ $job->location }}</div>
                        <div class="mb-1"><i class="fas fa-calendar-alt me-1"></i> Deadline: {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : '-' }}</div>
                        <span class="badge {{ $job->status == 'open' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($job->status) }}</span>
                    </div>
                    <div class="d-flex justify-content-end align-items-center mt-3 gap-2">
                        <a href="{{ route('jobs.public.show', $job->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-5">
            <i class="fas fa-briefcase fa-2x mb-3"></i><br>
            Belum ada lowongan kerja.
        </div>
        @endforelse
    </div>
</div>
@endsection 