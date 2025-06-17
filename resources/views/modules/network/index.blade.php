@extends('layouts.app')

@section('content')
<div class="container">
    <div class="search-bar mb-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari alumni...">
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

    <div class="network-list">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Profile Picture">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-1">Dr. Ahmad Hidayat</h5>
                        <p class="text-muted small mb-2">Dokter Umum - RS Medika Sejahtera</p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">Lihat Profil</button>
                            <button class="btn btn-sm btn-primary">Hubungi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Profile Picture">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-1">Nurul Hidayah, S.Kep</h5>
                        <p class="text-muted small mb-2">Perawat ICU - RS Sejahtera Medika</p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">Lihat Profil</button>
                            <button class="btn btn-sm btn-primary">Hubungi</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="Profile Picture">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-1">Muhammad Rizki, S.Farm</h5>
                        <p class="text-muted small mb-2">Apoteker - Klinik Sehat</p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-sm btn-outline-primary">Lihat Profil</button>
                            <button class="btn btn-sm btn-primary">Hubungi</button>
                        </div>
                    </div>
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
    .network-list .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .network-list .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .network-list .btn-sm {
        padding: 5px 15px;
        font-size: 0.9rem;
    }
</style>
@endpush 