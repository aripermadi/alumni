@extends('layouts.app')

@section('content')
<div class="hero-section mb-5 position-relative" style="overflow:hidden;">
    <div class="hero-gradient position-absolute w-100 h-100" style="z-index:1;"></div>
    <div class="container text-center text-white d-flex flex-column justify-content-center align-items-center h-100 position-relative" style="z-index:2; min-height:340px;">
        <div class="mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Alumni Icon" style="width:90px; height:90px; background:rgba(255,255,255,0.15); border-radius:50%; box-shadow:0 4px 24px rgba(13,110,253,0.13);">
        </div>
        <h1 class="display-3 fw-bold mb-2" style="letter-spacing:1px; text-shadow:0 2px 16px rgba(0,0,0,0.13);">Selamat Datang di <span style="color:#ffe066;">Alumni FK UNISMA</span></h1>
        <p class="lead mb-4" style="font-size:1.35rem; max-width:600px; margin:auto; text-shadow:0 1px 8px rgba(0,0,0,0.10);">Bangun koneksi, dapatkan informasi, dan berkembang bersama komunitas alumni terbaik.</p>
        {{-- <a href="/network" class="btn btn-lg px-5 py-3 fw-semibold shadow join-btn">Gabung Jaringan Alumni</a> --}}
    </div>
</div>
<div class="container">
    <div class="welcome-section mb-4">
        <div class="card welcome-card shadow-sm border-0 p-4 d-flex flex-row align-items-center" style="border-radius: 18px;">
            <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width:56px;height:56px;border-radius:50%;font-size:2rem;">
                <i class="fas fa-user"></i>
            </div>
            <div>
                <div class="d-flex align-items-center mb-1">
                    <span class="fs-5 fw-semibold me-2">Selamat Datang</span>
                    <span class="wave" style="font-size:1.7rem;">👋</span>
                </div>
                <div class="fw-bold fs-4" style="letter-spacing:0.5px;">
                    @auth
                        {{ Auth::user()->name }}
                    @else
                        Alumni Kedokteran UNISMA
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="quick-actions mb-4">
        <div class="d-none d-md-flex row g-3">
            <div class="col-md-3">
                <a href="/jobs" class="text-decoration-none">
                    <div class="quick-action-card d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-briefcase mb-2"></i>
                        <span class="mt-1">Lowongan</span>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="/news" class="text-decoration-none">
                    <div class="quick-action-card d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-newspaper mb-2"></i>
                        <span class="mt-1">Berita</span>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="/events" class="text-decoration-none">
                    <div class="quick-action-card d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-calendar-alt mb-2"></i>
                        <span class="mt-1">Event</span>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="/alumni" class="text-decoration-none">
                    <div class="quick-action-card d-flex flex-column align-items-center justify-content-center">
                        <i class="fas fa-network-wired mb-2"></i>
                        <span class="mt-1">Alumni</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="d-flex d-md-none flex-row overflow-auto gap-3 px-1" style="scroll-snap-type: x mandatory;">
            <a href="/jobs" class="text-decoration-none flex-shrink-0" style="width:110px;scroll-snap-align:center;">
                <div class="quick-action-card d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-briefcase mb-2"></i>
                    <span class="mt-1">Lowongan</span>
                </div>
            </a>
            <a href="/news/all" class="text-decoration-none flex-shrink-0" style="width:110px;scroll-snap-align:center;">
                <div class="quick-action-card d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-newspaper mb-2"></i>
                    <span class="mt-1">Berita</span>
                </div>
            </a>
            <a href="/events/all" class="text-decoration-none flex-shrink-0" style="width:110px;scroll-snap-align:center;">
                <div class="quick-action-card d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-calendar-alt mb-2"></i>
                    <span class="mt-1">Event</span>
                </div>
            </a>
            <a href="/alumni" class="text-decoration-none flex-shrink-0" style="width:110px;scroll-snap-align:center;">
                <div class="quick-action-card d-flex flex-column align-items-center justify-content-center">
                    <i class="fas fa-network-wired mb-2"></i>
                    <span class="mt-1">Alumni</span>
                </div>
            </a>
        </div>
    </div>

    <div class="upcoming-events mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Event Mendatang</h5>
            <a href="{{ route('events.all') }}" class="text-decoration-none">Lihat Semua</a>
        </div>
        <div class="card">
            <div class="card-body">
                @forelse($upcomingEvents as $event)
                    <div class="event-item mb-3">
                        @if($event->image)
                            <img src="{{ asset('storage/'.$event->image) }}" alt="Gambar Event" style="width:70px; height:70px; object-fit:cover; border-radius:10px; margin-right:15px;">
                        @endif
                        <div class="event-date" style="display:inline-block; min-width:60px; text-align:center;">
                            <span class="day">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</span>
                            <span class="month">{{ \Carbon\Carbon::parse($event->event_date)->format('M') }}</span>
                        </div>
                        <div class="event-details" style="display:inline-block; margin-left:15px; vertical-align:top;">
                            <h6 class="mb-1">{{ $event->title }}</h6>
                            <div class="countdown-event text-primary small mb-1" data-date="{{ $event->event_date }}" id="countdown-event-{{ $event->id }}"></div>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                {{ $event->location }}
                            </p>
                            <a href="{{ route('events.public.show', $event->id) }}" class="btn btn-link p-0">Lihat Detail</a>
                        </div>
                    </div>
                @empty
                    <div class="text-muted">Belum ada event mendatang.</div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="latest-news">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Berita Terbaru</h5>
            <a href="{{ route('news.all') }}" class="text-decoration-none">Lihat Semua</a>
        </div>
        <div class="card">
            <div class="card-body">
                @forelse($latestNews as $news)
                    <div class="news-item mb-3">
                        @if($news->image)
                            <img src="{{ asset('storage/'.$news->image) }}" class="news-image" alt="News">
                        @endif
                        <div class="news-details">
                            <h6 class="mb-1">{{ $news->title }}</h6>
                            <p class="text-muted small mb-0">{{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d M Y') : '-' }}</p>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($news->content), 80) }}</p>
                            <a href="{{ route('news.public.show', $news->id) }}" class="btn btn-link p-0">Baca selengkapnya</a>
                        </div>
                    </div>
                @empty
                    <div class="text-muted">Belum ada berita terbaru.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hero-section {
        position: relative;
        width: 100vw;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        min-height: 340px;
        background: none;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .hero-gradient {
        background: linear-gradient(120deg, #0d6efd 60%, #3a8dde 100%);
        opacity: 0.93;
        top: 0; left: 0; right: 0; bottom: 0;
        position: absolute;
    }
    @media (max-width: 768px) {
        .hero-section, .hero-gradient {
            min-height: 220px;
            height: 100%;
            padding: 30px 0;
        }
        .hero-section h1, .display-3 {
            font-size: 2rem !important;
        }
    }
    .welcome-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 4px 24px rgba(13,110,253,0.07);
        animation: fadeInUp 0.7s;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px);}
        to { opacity: 1; transform: translateY(0);}
    }
    .wave {
        animation: wave-hand 1.7s infinite;
        display: inline-block;
        transform-origin: 70% 70%;
    }
    @keyframes wave-hand {
        0% { transform: rotate(0deg);}
        10% { transform: rotate(14deg);}
        20% { transform: rotate(-8deg);}
        30% { transform: rotate(14deg);}
        40% { transform: rotate(-4deg);}
        50% { transform: rotate(10deg);}
        60% { transform: rotate(0deg);}
        100% { transform: rotate(0deg);}
    }
    .avatar {
        background: linear-gradient(135deg, #0d6efd 60%, #6ea8fe 100%);
    }
    .welcome-section {
        padding: 20px 0;
    }
    .quick-action-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        border: 1px solid #f0f0f0;
    }
    .quick-action-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 6px 24px rgba(13,110,253,0.15);
        border-color: #0d6efd22;
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
        box-shadow: 0 2px 8px rgba(13,110,253,0.08);
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
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .news-details {
        flex: 1;
    }
    .card {
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        border: none;
    }
    .btn-primary {
        background: linear-gradient(90deg, #0d6efd 60%, #3a8dde 100%);
        border: none;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #3a8dde 0%, #0d6efd 100%);
    }
    .d-flex.d-md-none.flex-row.overflow-auto {
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none; /* IE 10+ */
    }
    .d-flex.d-md-none.flex-row.overflow-auto::-webkit-scrollbar {
        display: none; /* Chrome/Safari/Webkit */
    }
    .join-btn {
        background: linear-gradient(90deg, #ffe066 0%, #0d6efd 100%);
        color: #212529;
        border: none;
        border-radius: 2rem;
        font-size: 1.2rem;
        box-shadow: 0 4px 24px rgba(13,110,253,0.13);
        transition: background 0.3s, color 0.3s, transform 0.2s;
    }
    .join-btn:hover {
        background: linear-gradient(90deg, #0d6efd 0%, #ffe066 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.countdown-event').forEach(function(el) {
        var dateStr = el.getAttribute('data-date');
        var target = new Date(dateStr);
        function updateCountdown() {
            var now = new Date();
            var diff = target - now;
            if (diff > 0) {
                var days = Math.ceil(diff / (1000*60*60*24));
                el.textContent = days + ' Hari Lagi';
            } else {
                el.textContent = 'Sedang berlangsung atau sudah lewat';
            }
        }
        updateCountdown();
        setInterval(updateCountdown, 1000*60*60); // update tiap jam
    });
});
</script>
@endpush 