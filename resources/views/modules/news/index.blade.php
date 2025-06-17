@extends('layouts.app')

@section('content')
<div class="container">
    <div class="search-bar mb-4">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Cari berita...">
            <button class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="categories mb-4">
        <div class="d-flex gap-2 overflow-auto">
            <button class="btn btn-outline-primary active">Semua</button>
            <button class="btn btn-outline-primary">Kesehatan</button>
            <button class="btn btn-outline-primary">Pendidikan</button>
            <button class="btn btn-outline-primary">Alumni</button>
            <button class="btn btn-outline-primary">Event</button>
        </div>
    </div>

    <div class="news-list">
        <div class="card mb-3">
            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="News Image">
            <div class="card-body">
                <h5 class="card-title">Inovasi Baru dalam Penanganan COVID-19</h5>
                <p class="text-muted small">10 Maret 2024</p>
                <p class="card-text">Peneliti UNISMA mengembangkan metode baru untuk penanganan pasien COVID-19 yang lebih efektif...</p>
                <a href="#" class="btn btn-link p-0">Baca selengkapnya</a>
            </div>
        </div>

        <div class="card mb-3">
            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="News Image">
            <div class="card-body">
                <h5 class="card-title">Fakultas Kedokteran UNISMA Raih Akreditasi A</h5>
                <p class="text-muted small">8 Maret 2024</p>
                <p class="card-text">Fakultas Kedokteran UNISMA berhasil meraih akreditasi A dari BAN-PT...</p>
                <a href="#" class="btn btn-link p-0">Baca selengkapnya</a>
            </div>
        </div>

        <div class="card mb-3">
            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="News Image">
            <div class="card-body">
                <h5 class="card-title">Alumni UNISMA Terpilih sebagai Dokter Terbaik 2024</h5>
                <p class="text-muted small">5 Maret 2024</p>
                <p class="card-text">Dr. Ahmad Hidayat, alumni Fakultas Kedokteran UNISMA angkatan 2015, terpilih sebagai dokter terbaik tahun 2024...</p>
                <a href="#" class="btn btn-link p-0">Baca selengkapnya</a>
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
    .news-list .card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .news-list .card-img-top {
        height: 200px;
        object-fit: cover;
    }
    .news-list .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .news-list .card-text {
        color: #6c757d;
        font-size: 0.9rem;
    }
</style>
@endpush 