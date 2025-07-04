@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-header mb-4">
        <div class="card">
            <div class="card-body text-center">
                <div class="d-flex justify-content-center">
                    <form action="{{ route('profile.update-picture') }}" method="POST" enctype="multipart/form-data" id="form-foto">
                        @csrf
                        <label for="foto" style="cursor:pointer;">
                            <img src="{{ Auth::user()->alumni && Auth::user()->alumni->foto ? asset('storage/' . Auth::user()->alumni->foto) : 'https://via.placeholder.com/100' }}" class="rounded-circle mb-3" alt="Profile Picture" style="width:100px;height:100px;object-fit:cover;border:3px solid #fff;box-shadow:0 2px 5px rgba(0,0,0,0.1);">
                            <input type="file" name="foto" id="foto" accept="image/*" class="d-none" onchange="document.getElementById('form-foto').submit()">
                        </label>
                    </form>
                </div>
                <h4 class="card-title mb-1">Selamat Datang,</h4>
                @auth
                    <h4 class="card-title mb-1">{{ Auth::user()->name }}
                        @if(Auth::user()->role === 'admin')
                            <span class="badge bg-danger ms-2" style="font-size:0.9rem;vertical-align:middle;">Admin</span>
                        @endif
                    </h4>
                @endauth
                <p class="text-muted mb-3">Alumni Kedokteran UNISMA</p>
                <div class="d-flex justify-content-center gap-3 my-4 flex-wrap">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center fw-semibold shadow-sm" style="font-size:1.1rem; transition:all .2s;">
                        <i class="fas fa-user-edit me-2"></i> Edit Profil
                    </a>
                    {{-- <a href="#" onclick="navigator.share ? navigator.share({title: document.title, url: window.location.href}) : alert('Fitur tidak didukung browser ini'); return false;" class="btn btn-info rounded-pill px-4 py-2 d-flex align-items-center fw-semibold shadow-sm" style="font-size:1.1rem; transition:all .2s;">
                        <i class="fas fa-share-alt me-2"></i> Bagikan Profil
                    </a> --}}
                    <a href="{{ route('profile.password') }}" class="btn btn-warning rounded-pill px-4 py-2 d-flex align-items-center fw-semibold shadow-sm" style="font-size:1.1rem; transition:all .2s;">
                        <i class="fas fa-key me-2"></i> Ganti Password
                    </a>
                    <a href="{{ route('logout') }}" class="btn btn-danger rounded-pill px-4 py-2 d-flex align-items-center fw-semibold shadow-sm" style="font-size:1.1rem; transition:all .2s;"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->role === 'admin')
    <div class="d-flex justify-content-center gap-3 my-4 flex-wrap">
        <a href="{{ route('news.index') }}" class="btn btn-info rounded-pill px-4 py-2 d-flex align-items-center fw-semibold shadow-sm" style="font-size:1.1rem; transition:all .2s;">
            <i class="fas fa-newspaper me-2"></i> Kelola Berita
        </a>
        <a href="{{ route('events.index') }}" class="btn btn-warning rounded-pill px-4 py-2 d-flex align-items-center fw-semibold shadow-sm" style="font-size:1.1rem; transition:all .2s;">
            <i class="fas fa-calendar-alt me-2"></i> Kelola Event
        </a>
        <a href="{{ route('user.index') }}" class="btn btn-success rounded-pill px-4 py-2 d-flex align-items-center fw-semibold shadow-sm" style="font-size:1.1rem; transition:all .2s;">
            <i class="fas fa-users-cog me-2"></i> Kelola User
        </a>
    </div>
    @endif

    <div class="profile-content">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Informasi Pribadi</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Nama Lengkap:</strong> @auth{{ Auth::user()->name }}@endauth</p>
                        <p class="mb-2"><strong>Email:</strong> @auth{{ Auth::user()->email }}@endauth</p>
                        <p class="mb-2"><strong>No. Telepon:</strong> {{ Auth::user()->alumni ? Auth::user()->alumni->no_hp : '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Alamat:</strong> {{ Auth::user()->alumni ? Auth::user()->alumni->alamat : '-' }}</p>
                        <p class="mb-2"><strong>Pekerjaan:</strong> {{ Auth::user()->alumni ? Auth::user()->alumni->pekerjaan : '-' }}</p>
                        <p class="mb-2"><strong>Instansi:</strong> -</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Pendidikan</h5>
                <div class="timeline">
                    <div class="timeline-item">
                        <h6 class="mb-1">S1 Kedokteran</h6>
                        <p class="text-muted small mb-0">Universitas Islam Malang (2015-2021)</p>
                    </div>
                    <div class="timeline-item">
                        <h6 class="mb-1">SMA Negeri 1 Malang</h6>
                        <p class="text-muted small mb-0">2012-2015</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Pengalaman Kerja</h5>
                <div class="timeline">
                    <div class="timeline-item">
                        <h6 class="mb-1">Dokter Umum</h6>
                        <p class="text-muted small mb-0">RS Medika Sejahtera (2021-Sekarang)</p>
                    </div>
                    <div class="timeline-item">
                        <h6 class="mb-1">Dokter Internship</h6>
                        <p class="text-muted small mb-0">RS Sejahtera Medika (2020-2021)</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection

@push('styles')
<style>
    .profile-header .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .profile-header img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .profile-content .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .timeline {
        position: relative;
        padding-left: 20px;
    }
    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }
    .timeline-item:not(:last-child)::before {
        content: '';
        position: absolute;
        left: -20px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }
    .timeline-item::after {
        content: '';
        position: absolute;
        left: -24px;
        top: 0;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #0d6efd;
        border: 2px solid #fff;
    }
    .btn:hover {
        transform: translateY(-2px) scale(1.04);
        box-shadow: 0 6px 24px rgba(0,0,0,0.12);
        opacity: 0.92;
    }
</style>
@endpush 