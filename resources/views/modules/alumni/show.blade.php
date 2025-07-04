@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 p-4" style="border-radius:1.2rem;">
                <div class="text-center mb-4">
                    <img src="{{ $alumni->foto ? asset('storage/'.$alumni->foto) : 'https://ui-avatars.com/api/?name='.urlencode($alumni->user->name) }}" class="rounded-circle" alt="Foto Alumni" style="width:120px; height:120px; object-fit:cover; border:5px solid #e9ecef;">
                </div>
                <h3 class="text-center fw-bold mb-1">{{ $alumni->user->name }}</h3>
                <div class="text-center text-muted mb-3">{{ $alumni->user->email }}</div>
                <div class="row mb-2">
                    <div class="col-5 fw-semibold">Angkatan</div>
                    <div class="col-7">: {{ $alumni->angkatan ?? '-' }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 fw-semibold">Jurusan</div>
                    <div class="col-7">: {{ $alumni->jurusan ?? '-' }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 fw-semibold">Pekerjaan</div>
                    <div class="col-7">: {{ $alumni->pekerjaan ?? '-' }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 fw-semibold">Alamat</div>
                    <div class="col-7">: {{ $alumni->alamat ?? '-' }}</div>
                </div>
                <div class="row mb-2">
                    <div class="col-5 fw-semibold">No. HP</div>
                    <div class="col-7">: {{ $alumni->no_hp ?? '-' }}</div>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('alumni.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
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