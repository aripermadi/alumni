@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
                        <h2 class="fw-bold text-center flex-grow-1 mb-0" style="letter-spacing:1px;">Manajemen User</h2>
                        <a href="{{ route('user.create') }}" class="btn btn-primary rounded-pill px-4 py-2 ms-md-3 shadow-sm d-flex align-items-center" style="letter-spacing:1px;">
                            <i class="fas fa-user-plus me-2"></i> Tambah User
                        </a>
                    </div>
                    <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                        <div class="input-group input-group-lg">
                            <input type="text" name="q" class="form-control rounded-start-pill ps-4 @if(request('q')) border-primary @endif" placeholder="Cari nama/email user..." value="{{ request('q') }}">
                            <button class="btn btn-outline-primary rounded-end-pill px-4" type="submit"><i class="fas fa-search"></i> Cari</button>
                        </div>
                    </form>
                    @if($users->count())
                    <div class="row g-4">
                        @foreach($users as $user)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0 rounded-4">
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-secondary' }} px-3 py-2 fs-6 shadow-sm me-2">{{ ucfirst($user->role) }}</span>
                                            <span class="fw-bold fs-5">{{ $user->name }}</span>
                                        </div>
                                        <div class="text-muted mb-2"><i class="fas fa-envelope me-1"></i> {{ $user->email }}</div>
                                    </div>
                                    <div class="d-flex gap-2 mt-auto">
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm rounded-pill px-3 d-inline-flex align-items-center shadow-sm" style="font-weight:500;">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 d-inline-flex align-items-center shadow-sm" style="font-weight:500;">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $users->withQueryString()->links() }}
                    </div>
                    @else
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-users fa-2x mb-3"></i><br>
                        Belum ada user.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 