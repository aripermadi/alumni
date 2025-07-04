@extends('layouts.app')

@section('content')
<div class="container">
    <div class="profile-header mb-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="https://via.placeholder.com/100" class="rounded-circle mb-3" alt="Profile Picture">
                <h4 class="card-title mb-1">Selamat Datang,</h4>
                @auth
                    <h4 class="card-title mb-1">{{ Auth::user()->name }}</h4>
                @endauth
                <p class="text-muted mb-3">Alumni Kedokteran UNISMA</p>
                <div class="d-flex justify-content-center gap-2">
                    <button class="btn btn-primary">Edit Profil</button>
                    <button class="btn btn-outline-primary">Bagikan Profil</button>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-content">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Informasi Pribadi</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Nama Lengkap:</strong> @auth{{ Auth::user()->name }}@endauth</p>
                        <p class="mb-2"><strong>Email:</strong> @auth{{ Auth::user()->email }}@endauth</p>
                        <p class="mb-2"><strong>No. Telepon:</strong> -</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Alamat:</strong> -</p>
                        <p class="mb-2"><strong>Pekerjaan:</strong> -</p>
                        <p class="mb-2"><strong>Instansi:</strong> -</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
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
        </div>
    </div>

    @auth
    <div class="d-flex justify-content-center mt-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas fa-sign-out-alt me-1"></i> Logout</button>
        </form>
    </div>
    @endauth
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
</style>
@endpush 