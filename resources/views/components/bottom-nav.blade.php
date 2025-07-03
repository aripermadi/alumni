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
        <a href="/network" class="col nav-item {{ $active === 'network' ? 'active' : '' }} text-decoration-none">
            <i class="fas fa-network-wired"></i>
            <span>Jaringan</span>
        </a>
        <a href="/events" class="col nav-item {{ $active === 'events' ? 'active' : '' }} text-decoration-none">
            <i class="fas fa-calendar-alt"></i>
            <span>Event</span>
        </a>
        @auth
            <a href="/profile" class="col nav-item {{ $active === 'profile' ? 'active' : '' }} text-decoration-none">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="col nav-item m-0 p-0" style="display:inline; background:none; border:none;">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0" style="color:inherit; text-decoration:none;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span style="font-size:0.8rem;">Logout</span>
                </button>
            </form>
        @else
            <a href="/login" class="col nav-item {{ $active === 'profile' ? 'active' : '' }} text-decoration-none">
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
    .nav-item i {
        font-size: 1.5rem;
        margin-bottom: 4px;
        transition: transform 0.3s ease;
    }
    .nav-item.active {
        color: #0d6efd;
    }
    .nav-item.active i {
        transform: translateY(-2px);
    }
    .nav-item span {
        font-size: 0.8rem;
        display: block;
        transition: color 0.3s ease;
    }
    .nav-item:hover {
        color: #0d6efd;
    }
    .nav-item:hover i {
        transform: translateY(-2px);
    }
</style> 