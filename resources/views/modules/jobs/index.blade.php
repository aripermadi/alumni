@extends('layouts.app')

@section('content')
<div class="container">
    <div class="search-bar mb-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari lowongan kerja...">
            <button class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="categories mb-4">
        <div class="d-flex gap-2 overflow-auto">
            <button class="btn btn-outline-primary active">Semua</button>
            <button class="btn btn-outline-primary">Dokter</button>
            <button class="btn btn-outline-primary">Perawat</button>
            <button class="btn btn-outline-primary">Apoteker</button>
            <button class="btn btn-outline-primary">Admin</button>
        </div>
    </div>

    <div class="jobs-list">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Dokter Umum</h5>
                        <p class="text-muted small mb-2">RS Medika Sejahtera</p>
                        <div class="d-flex gap-2 mb-2">
                            <span class="badge bg-primary">Full-time</span>
                            <span class="badge bg-success">Rp 15-20jt</span>
                        </div>
                        <p class="card-text">Dibutuhkan dokter umum untuk bergabung dengan tim kami...</p>
                    </div>
                    <button class="btn btn-outline-primary">Lamar</button>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Perawat ICU</h5>
                        <p class="text-muted small mb-2">RS Sejahtera Medika</p>
                        <div class="d-flex gap-2 mb-2">
                            <span class="badge bg-primary">Full-time</span>
                            <span class="badge bg-success">Rp 8-12jt</span>
                        </div>
                        <p class="card-text">Membutuhkan perawat ICU berpengalaman minimal 2 tahun...</p>
                    </div>
                    <button class="btn btn-outline-primary">Lamar</button>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Apoteker</h5>
                        <p class="text-muted small mb-2">Klinik Sehat</p>
                        <div class="d-flex gap-2 mb-2">
                            <span class="badge bg-primary">Full-time</span>
                            <span class="badge bg-success">Rp 7-10jt</span>
                        </div>
                        <p class="card-text">Dibutuhkan apoteker untuk mengelola apotek klinik...</p>
                    </div>
                    <button class="btn btn-outline-primary">Lamar</button>
                </div>
            </div>
        </div>
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