@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 fw-bold">Daftar Alumni</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle bg-white">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ahmad Fauzi</td>
                    <td>2015</td>
                    <td>ahmad.fauzi@email.com</td>
                </tr>
                <tr>
                    <td>Siti Rahmawati</td>
                    <td>2017</td>
                    <td>siti.rahma@email.com</td>
                </tr>
                <tr>
                    <td>Budi Santoso</td>
                    <td>2016</td>
                    <td>budi.santoso@email.com</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection 