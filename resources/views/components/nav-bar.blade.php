@props(['active' => 'home'])
@php
    use Illuminate\Support\Facades\Auth;
@endphp
<nav class="navbar navbar-expand-lg navbar-light custom-navbar d-none d-lg-block shadow-sm" style="display:none;@media (min-width:992px){display:flex!important;}">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
            <i class="fas fa-graduation-cap me-2 text-primary"></i> Alumni
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse show" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link px-3 {{ $active === 'home' ? 'active' : '' }}" href="/">
                        <i class="fas fa-home me-1"></i> Beranda
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link px-3 {{ $active === 'network' ? 'active' : '' }}" href="/network">
                        <i class="fas fa-network-wired me-1"></i> Jaringan
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link px-3 {{ $active === 'events' ? 'active' : '' }}" href="/events/all">
                        <i class="fas fa-calendar-alt me-1"></i> Event
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ $active === 'news' ? 'active' : '' }}" href="/news/all">
                        <i class="fas fa-newspaper me-1"></i> Berita
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link px-3 {{ $active === 'forum' ? 'active' : '' }}" href="/forum">
                        <i class="fas fa-comments me-1"></i> Forum
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 {{ $active === 'alumni' ? 'active' : '' }}" href="/alumni">
                        <i class="fas fa-users me-1"></i> Alumni
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ $active === 'profile' ? 'active' : '' }}" href="{{ route('profile.index') }}">
                            <i class="fas fa-user me-1"></i> Profil
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ in_array($active, ['profile','login','register']) ? 'active' : '' }}" href="/login">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<style>
    .custom-navbar {
        background: linear-gradient(90deg, #f8fafc 0%, #e3f0ff 100%);
        border-bottom: 1px solid #e3e3e3;
    }
    .custom-navbar .navbar-brand {
        font-size: 1.5rem;
        letter-spacing: 1px;
    }
    .custom-navbar .nav-link {
        color: #495057;
        font-weight: 500;
        border-radius: 0.5rem;
        transition: background 0.2s, color 0.2s;
        display: flex;
        align-items: center;
    }
    .custom-navbar .nav-link i {
        color: #6c757d;
        transition: color 0.3s;
    }
    .custom-navbar .nav-link.active, .custom-navbar .nav-link:hover {
        background: #e3f0ff;
        color: #1565c0;
    }
    .custom-navbar .nav-link.active i, .custom-navbar .nav-link:hover i {
        color: #1565c0;
    }
    .custom-navbar .nav-link.btn-link {
        border: none;
        background: none;
        box-shadow: none;
    }
    .custom-navbar .nav-link.btn-link:focus {
        outline: none;
        box-shadow: none;
    }
</style> 