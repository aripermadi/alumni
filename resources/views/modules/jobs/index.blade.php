@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <h2 class="fw-bold mb-0">Daftar Lowongan Kerja</h2>
        <a href="{{ route('jobs.create') }}" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center fw-semibold shadow-sm">
            <i class="fas fa-plus me-2"></i> Tambah Lowongan
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
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
                    <div class="d-flex justify-content-between align-items-center mt-3 gap-2">
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary btn-sm rounded-pill">Detail</a>
                        <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning btn-sm rounded-pill">Edit</a>
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('Yakin hapus lowongan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm rounded-pill">Hapus</button>
                        </form>
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

@push('styles')
<style>
    .search-bar .input-group {
        background: white;
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .search-bar input {
        border: none;
        padding: 10px;
    }
    .search-bar input:focus {
        box-shadow: none;
    }
    .search-bar .btn {
        border-radius: 8px;
    }
    .categories {
        padding: 5px 0;
    }
    .categories .btn {
        white-space: nowrap;
        border-radius: 20px;
    }
    .jobs-list .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .jobs-list .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .jobs-list .card-text {
        color: #6c757d;
        font-size: 0.9rem;
    }
    .badge {
        font-weight: 500;
        padding: 5px 10px;
    }
</style>
@endpush 