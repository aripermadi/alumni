@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(120deg, #e0eafc 0%, #cfdef3 100%) !important;
    }
    .auth-card {
        border: none;
        border-radius: 1.2rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        background: #fff;
        overflow: hidden;
    }
    .auth-card-header {
        background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
        color: #fff;
        font-weight: bold;
        font-size: 1.3rem;
        letter-spacing: 1px;
        border-bottom: none;
        text-align: center;
        padding: 1.2rem 0 0.7rem 0;
    }
    .auth-logo {
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
    .auth-illustration {
        width: 100%;
        max-width: 220px;
        margin: 0 auto 1.2rem auto;
        display: block;
    }
    .auth-input-group {
        position: relative;
    }
    .auth-input-group .form-control {
        padding-left: 2.5rem;
        border-radius: 0.7rem;
        border: 1px solid #e3e3e3;
        box-shadow: none;
        transition: border 0.2s;
    }
    .auth-input-group .form-control:focus {
        border: 1.5px solid #4f8cff;
        box-shadow: 0 0 0 0.1rem #4f8cff22;
    }
    .auth-input-group .input-icon {
        position: absolute;
        left: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        color: #4f8cff;
        font-size: 1.1rem;
    }
    .auth-btn {
        background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
        border: none;
        border-radius: 0.7rem;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 2px 8px 0 #4f8cff22;
        transition: background 0.2s, box-shadow 0.2s;
    }
    .auth-btn:hover {
        background: linear-gradient(90deg, #38b6ff 0%, #4f8cff 100%);
        box-shadow: 0 4px 16px 0 #4f8cff33;
    }
    .auth-message {
        text-align: center;
        color: #6c757d;
        font-size: 1rem;
        margin-top: 1.2rem;
        margin-bottom: 0.2rem;
    }
    .auth-tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 1.5rem;
    }
    .auth-tab {
        padding: 0.7rem 2.2rem;
        cursor: pointer;
        background: #f3f7fa;
        border: none;
        border-radius: 1.2rem 1.2rem 0 0;
        font-weight: 600;
        color: #4f8cff;
        margin: 0 0.2rem;
        transition: background 0.2s, color 0.2s;
    }
    .auth-tab.active {
        background: linear-gradient(90deg, #4f8cff 0%, #38b6ff 100%);
        color: #fff;
    }
    @media (min-width: 992px) {
        .auth-illustration {
            position: absolute;
            left: -240px;
            top: 50%;
            transform: translateY(-50%);
            max-width: 220px;
            margin: 0;
        }
        .auth-card-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }
</style>
<div class="container min-vh-100 d-flex align-items-center justify-content-center" style="padding-top:40px; padding-bottom:40px;">
    <div class="row w-100 justify-content-center">
        <div class="col-md-6 col-lg-5 auth-card-wrapper">
            {{-- <img src="https://undraw.co/api/illustrations/0f8b7e7e-2e3e-4e2e-8e2e-0e2e0e2e0e2e" alt="Auth Ilustrasi" class="auth-illustration d-none d-lg-block"> --}}
            <div class="card auth-card w-100">
                <div class="auth-card-header">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/99/Logo_UNISMA.png" alt="Logo UNISMA" class="auth-logo">
                    <div><i class="fas fa-user-circle me-2"></i> Portal Alumni UNISMA</div>
                </div>
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3 auth-input-group">
                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autofocus>
                        </div>
                        <div class="mb-3 auth-input-group">
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn auth-btn w-100 py-2 mt-2">Login</button>
                    </form>
                    <div class="auth-message mt-3">
                        Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>.<br>
                        Bergabunglah dengan Portal Alumni UNISMA untuk terhubung dengan alumni, info event, dan peluang karir terbaru.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showTab(tab) {
        document.getElementById('loginForm').style.display = tab === 'login' ? 'block' : 'none';
        document.getElementById('registerForm').style.display = tab === 'register' ? 'block' : 'none';
        document.getElementById('loginTab').classList.toggle('active', tab === 'login');
        document.getElementById('registerTab').classList.toggle('active', tab === 'register');
    }
</script>
@endsection 