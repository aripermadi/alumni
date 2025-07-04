@props(['active' => 'home'])

@php
    use Illuminate\Support\Facades\Auth;
@endphp

<nav class="bottom-nav d-lg-none">
    <div class="row g-0">
        <a href="/" class="col nav-item {{ $active === 'home' ? 'active' : '' }} text-decoration-none">
            <i class="fas fa-home"></i>
            <span>Beranda</span>
        </a>
        {{-- <a href="/network" class="col nav-item {{ $active === 'network' ? 'active' : '' }} text-decoration-none">
            <i class="fas fa-network-wired"></i>
            <span>Jaringan</span>
        </a> --}}
        {{-- <a href="/events/all" class="col nav-item {{ $active === 'events' ? 'active' : '' }} text-decoration-none">
            <i class="fas fa-calendar-alt"></i>
            <span>Event</span>
        </a>
        <a href="/news/all" class="col nav-item {{ $active === 'news' ? 'active' : '' }} text-decoration-none">
            <i class="fas fa-newspaper"></i>
            <span>Berita</span>
        </a> --}}
        <a href="/forum" class="col nav-item {{ $active === 'forum' ? 'active' : '' }} text-decoration-none">
            <i class="fas fa-comments"></i>
            <span>Forum</span>
        </a>
        <a href="/alumni" class="col nav-item {{ $active === 'alumni' ? 'active' : '' }} text-decoration-none">
            <i class="fas fa-users"></i>
            <span>Alumni</span>
        </a>
        @auth
            <a href="/profile" class="col nav-item {{ $active === 'profile' ? 'active' : '' }} text-decoration-none">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
        @else
            <a href="/login" class="col nav-item {{ in_array($active, ['profile','login','register']) ? 'active' : '' }} text-decoration-none">
                <i class="fas fa-sign-in-alt"></i>
                <span>Login</span>
            </a>
        @endauth
    </div>
</nav>

<style>
    .bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        z-index: 1000;
    }
    .nav-item {
        text-align: center;
        padding: 8px 0;
        color: #6c757d;
        transition: all 0.3s ease;
    }
    .nav-item i, .nav-item span {
        color: #6c757d;
        transition: color 0.3s;
    }
    .nav-item.active i, .nav-item.active span {
        color: #1565c0;
    }
    .nav-item.active {
        color: #1565c0;
        background: none;
    }
    .nav-item.active i {
        transform: translateY(-2px);
    }
    .nav-item:hover {
        color: #1565c0;
    }
    .nav-item:hover i {
        transform: translateY(-2px);
    }
    .nav-item span {
        font-size: 0.8rem;
        display: block;
        transition: color 0.3s ease;
    }
</style> 