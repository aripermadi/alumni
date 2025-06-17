@extends('layouts.app')

@section('content')
<div class="container">
    <div class="search-bar mb-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari event...">
            <button class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="categories mb-4">
        <div class="d-flex gap-2 overflow-auto">
            <button class="btn btn-outline-primary active">Semua</button>
            <button class="btn btn-outline-primary">Seminar</button>
            <button class="btn btn-outline-primary">Workshop</button>
            <button class="btn btn-outline-primary">Reuni</button>
            <button class="btn btn-outline-primary">Webinar</button>
        </div>
    </div>

    <div class="events-list">
        <div class="card mb-3">
            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Event Image">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Seminar Kesehatan Mental</h5>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-calendar"></i> 15 Maret 2024
                            <i class="fas fa-clock ms-2"></i> 09:00 WIB
                        </p>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-map-marker-alt"></i> Aula UNISMA
                        </p>
                        <p class="card-text">Seminar tentang pentingnya kesehatan mental di kalangan mahasiswa...</p>
                    </div>
                    <button class="btn btn-primary">Daftar</button>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Event Image">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Workshop Penulisan Karya Ilmiah</h5>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-calendar"></i> 20 Maret 2024
                            <i class="fas fa-clock ms-2"></i> 13:00 WIB
                        </p>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-map-marker-alt"></i> Ruang Seminar FK
                        </p>
                        <p class="card-text">Workshop tentang teknik penulisan karya ilmiah yang baik dan benar...</p>
                    </div>
                    <button class="btn btn-primary">Daftar</button>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="Event Image">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="card-title">Reuni Akbar Alumni FK</h5>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-calendar"></i> 25 Maret 2024
                            <i class="fas fa-clock ms-2"></i> 18:00 WIB
                        </p>
                        <p class="text-muted small mb-2">
                            <i class="fas fa-map-marker-alt"></i> Hotel Sejahtera
                        </p>
                        <p class="card-text">Acara reuni akbar untuk alumni Fakultas Kedokteran UNISMA...</p>
                    </div>
                    <button class="btn btn-primary">Daftar</button>
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
    .events-list .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .events-list .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    .events-list .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .events-list .card-text {
        color: #6c757d;
        font-size: 0.9rem;
    }
    .events-list .btn-primary {
        border-radius: 20px;
        padding: 8px 20px;
    }
</style>
@endpush 