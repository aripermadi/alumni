@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    @if($job->logo)
                        <div class="text-center mb-3"><img src="{{ asset('storage/'.$job->logo) }}" alt="Logo" style="max-width:80px;max-height:80px;"></div>
                    @endif
                    <h2 class="fw-bold mb-3">{{ $job->title }}</h2>
                    <div class="mb-2"><i class="fas fa-building me-1"></i> <strong>Perusahaan:</strong> {{ $job->company }}</div>
                    <div class="mb-2"><i class="fas fa-map-marker-alt me-1"></i> <strong>Lokasi:</strong> {{ $job->location }}</div>
                    <div class="mb-2"><i class="fas fa-calendar-alt me-1"></i> <strong>Deadline:</strong> {{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : '-' }}</div>
                    <div class="mb-2"><i class="fas fa-link me-1"></i> <strong>Link:</strong> @if($job->link)<a href="{{ $job->link }}" target="_blank">{{ $job->link }}</a>@else - @endif</div>
                    <div class="mb-2"><span class="badge {{ $job->status == 'open' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($job->status) }}</span></div>
                    <div class="mb-4"><strong>Deskripsi:</strong><br>{!! nl2br(e($job->description)) !!}</div>
                    <div class="d-flex justify-content-start align-items-center mt-4">
                        <a href="{{ route('jobs.all') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 