@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%) !important;
    }
    .register-card {
        border: none;
        border-radius: 1.2rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        background: #fff;
        overflow: hidden;
    }
    .register-card-header {
        background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
        color: #fff;
        font-weight: bold;
        font-size: 1.3rem;
        letter-spacing: 1px;
        border-bottom: none;
        text-align: center;
        padding: 1.2rem 0 0.7rem 0;
    }
    .register-logo {
        width: 100px;
        height: 100px;
        object-fit: contain;
        margin-bottom: 0.5rem;
        margin-top: -3.5rem;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 2px 8px 0 #4f8cff22;
        border: 3px solid #e0eafc;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .register-illustration {
        width: 100%;
        max-width: 220px;
        margin: 0 auto 1.2rem auto;
        display: block;
    }
    .register-input-group {
        position: relative;
    }
    .register-input-group .form-control {
        padding-left: 2.5rem;
        border-radius: 0.7rem;
        border: 1px solid #e3e3e3;
        box-shadow: none;
        transition: border 0.2s;
    }
    .register-input-group .form-control:focus {
        border: 1.5px solid #4f8cff;
        box-shadow: 0 0 0 0.1rem #4f8cff22;
    }
    .register-input-group .input-icon {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: #4f8cff;
        font-size: 1.1rem;
    }
    .register-btn {
        background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
        border: none;
        border-radius: 0.7rem;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 2px 8px 0 #4f8cff22;
        transition: background 0.2s, box-shadow 0.2s;
    }
    .register-btn:hover {
        background: linear-gradient(90deg, #38b6ff 0%, #4f8cff 100%);
        box-shadow: 0 4px 16px 0 #4f8cff33;
    }
    .register-message {
        text-align: center;
        color: #6c757d;
        font-size: 1rem;
        margin-top: 1.2rem;
        margin-bottom: 0.2rem;
    }
    @media (min-width: 992px) {
        .register-illustration {
            position: absolute;
            left: -240px;
            top: 50%;
            transform: translateY(-50%);
            max-width: 220px;
            margin: 0;
        }
        .register-card-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }
</style>
<div class="container min-vh-100 d-flex align-items-center justify-content-center" style="padding-top:40px; padding-bottom:40px;">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5 register-card-wrapper">
            <img src="https://undraw.co/api/illustrations/0f8b7e7e-2e3e-4e2e-8e2e-0e2e0e2e0e2e" alt="Register Ilustrasi" class="register-illustration d-none d-lg-block">
            <div class="card register-card w-100">
                <div class="register-card-header">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Logo_UNISMA.png" alt="Logo UNISMA" class="register-logo">
                    <div><i class="fas fa-user-plus me-2"></i> Registrasi Akun Alumni</div>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                        </div>
                        <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-graduation-cap"></i></span>
                            <select class="form-control" id="angkatan" name="angkatan" required>
                                <option value="">Pilih Angkatan</option>
                                @for ($year = date('Y'); $year >= 2005; $year--)
                                    <option value="{{ $year }}" {{ old('angkatan') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                        {{-- <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-book"></i></span>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan" value="{{ old('jurusan') }}" required>
                        </div> --}}
                        <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-briefcase"></i></span>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="{{ old('pekerjaan') }}">
                        </div>
                        <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-map-marker-alt"></i></span>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
                        </div>
                        <div id="map-alamat" style="height: 250px; border-radius: 12px; margin-bottom: 1rem;"></div>
                        <button type="button" id="btn-lokasi-saya" class="btn btn-outline-primary btn-sm mb-3"><i class="fas fa-location-arrow me-1"></i> Gunakan Lokasi Saya</button>
                        <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-phone"></i></span>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. HP" value="{{ old('no_hp') }}">
                        </div>
                        {{-- <div class="mb-3 register-input-group">
                            <span class="input-icon"><i class="fas fa-image"></i></span>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        </div> --}}
                        <button type="submit" class="btn register-btn w-100 py-2 mt-2">Daftar</button>
                    </form>
                    <div class="register-message">
                        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>.<br>
                        Bergabunglah dengan Portal Alumni UNISMA untuk terhubung dengan jaringan alumni, info event, dan peluang karir terbaru.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var map = L.map('map-alamat').setView([-7.9797, 112.6304], 13); // Koordinat default Malang
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker;
    var alamatInput = document.getElementById('alamat');

    // Geocoder
    var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false
    })
    .on('markgeocode', function(e) {
        var latlng = e.geocode.center;
        if (marker) map.removeLayer(marker);
        marker = L.marker(latlng).addTo(map);
        map.setView(latlng, 16);
        alamatInput.value = e.geocode.name;
    })
    .addTo(map);

    // Klik map untuk set marker & reverse geocode
    map.on('click', function(e) {
        if (marker) map.removeLayer(marker);
        marker = L.marker(e.latlng).addTo(map);
        fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${e.latlng.lat}&lon=${e.latlng.lng}`)
            .then(res => res.json())
            .then(data => {
                alamatInput.value = data.display_name || `${e.latlng.lat},${e.latlng.lng}`;
            });
    });

    // Gunakan Lokasi Saya
    document.getElementById('btn-lokasi-saya').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var latlng = [lat, lng];
                if (marker) map.removeLayer(marker);
                marker = L.marker(latlng).addTo(map);
                map.setView(latlng, 16);
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                    .then(res => res.json())
                    .then(data => {
                        alamatInput.value = data.display_name || `${lat},${lng}`;
                    });
            }, function() {
                alert('Gagal mengambil lokasi. Pastikan izin lokasi diaktifkan.');
            });
        } else {
            alert('Browser Anda tidak mendukung geolokasi.');
        }
    });
});
</script>
@endpush
@endsection 