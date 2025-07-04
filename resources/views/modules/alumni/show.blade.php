@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 p-4 d-flex flex-column align-items-center justify-content-center text-center" style="border-radius:1.2rem;">
                <img src="{{ $alumni->foto ? asset('storage/'.$alumni->foto) : 'https://ui-avatars.com/api/?name='.urlencode($alumni->user->name) }}" class="rounded-circle mb-3" alt="Foto Alumni" style="width:120px; height:120px; object-fit:cover; border:5px solid #e9ecef;">
                <h3 class="fw-bold mb-1">{{ $alumni->user->name }}</h3>
                <div class="text-muted mb-3">{{ $alumni->user->email }}</div>
                <div class="mb-2"><span class="fw-semibold">Angkatan</span> : {{ $alumni->angkatan ?? '-' }}</div>
                <div class="mb-2"><span class="fw-semibold">Jurusan</span> : {{ $alumni->jurusan ?? '-' }}</div>
                <div class="mb-2"><span class="fw-semibold">Pekerjaan</span> : {{ $alumni->pekerjaan ?? '-' }}</div>
                <div class="mb-2"><span class="fw-semibold">Alamat</span> : {{ $alumni->alamat ?? '-' }}</div>
                @if($alumni->locations->last())
                    <div class="mb-2">
                        <span class="fw-semibold">Koordinat Lokasi</span> :
                        <a href="https://maps.google.com/?q={{ $alumni->locations->last()->latitude }},{{ $alumni->locations->last()->longitude }}" target="_blank">
                            {{ $alumni->locations->last()->latitude }}, {{ $alumni->locations->last()->longitude }}
                        </a>
                    </div>
                @endif
                <div class="mb-2"><span class="fw-semibold">No. HP</span> : {{ $alumni->no_hp ?? '-' }}</div>
                <a href="{{ route('alumni.index') }}" class="btn btn-secondary mt-4"><i class="fas fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card {
    border-radius: 1.2rem;
}
</style>
@endpush 