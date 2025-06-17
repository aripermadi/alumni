@extends('layouts.app')

@section('content')
<div class="container">
    <div class="welcome-section mb-4">
        <h4 class="mb-1">Selamat Datang,</h4>
        <p class="text-muted mb-0">Alumni Kedokteran UNISMA</p>
    </div>

    <div class="quick-actions mb-4">
        <div class="row g-3">
            <div class="col-6">
                <a href="/jobs" class="text-decoration-none">
                    <div class="quick-action-card">
                        <i class="fas fa-briefcase"></i>
                        <span>Lowongan</span>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="/news" class="text-decoration-none">
                    <div class="quick-action-card">
                        <i class="fas fa-newspaper"></i>
                        <span>Berita</span>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="/events" class="text-decoration-none">
                    <div class="quick-action-card">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Event</span>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a href="/network" class="text-decoration-none">
                    <div class="quick-action-card">
                        <i class="fas fa-network-wired"></i>
                        <span>Jaringan</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="upcoming-events mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Event Mendatang</h5>
            <a href="/events" class="text-decoration-none">Lihat Semua</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="event-item">
                    <div class="event-date">
                        <span class="day">15</span>
                        <span class="month">Mar</span>
                    </div>
                    <div class="event-details">
                        <h6 class="mb-1">Seminar Kesehatan Nasional</h6>
                        <p class="text-muted small mb-0">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Aula FK UNISMA
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="latest-news">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Berita Terbaru</h5>
            <a href="/news" class="text-decoration-none">Lihat Semua</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="news-item">
                    <img src="https://via.placeholder.com/100" class="news-image" alt="News">
                    <div class="news-details">
                        <h6 class="mb-1">Inovasi Baru dalam Penanganan COVID-19</h6>
                        <p class="text-muted small mb-0">10 Maret 2024</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .welcome-section {
        padding: 20px 0;
    }
    .quick-action-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .quick-action-card:hover {
        transform: translateY(-5px);
    }
    .quick-action-card i {
        font-size: 2rem;
        color: #0d6efd;
        margin-bottom: 10px;
    }
    .quick-action-card span {
        color: #212529;
        font-weight: 500;
    }
    .event-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .event-date {
        background: #0d6efd;
        color: white;
        padding: 10px;
        border-radius: 10px;
        text-align: center;
        min-width: 60px;
    }
    .event-date .day {
        font-size: 1.5rem;
        font-weight: 600;
        display: block;
    }
    .event-date .month {
        font-size: 0.9rem;
    }
    .news-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .news-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
    }
    .news-details {
        flex: 1;
    }
</style>
@endpush 