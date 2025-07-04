@extends('layouts.app')

@section('content')
<div class="container mt-4">
    
    <form method="GET" action="{{ route('alumni.index') }}" class="mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-center">Data Alumni</h3>
        </div>
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari nama alumni..." value="{{ request('q') }}">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
        </div>
    </form>
    <div id="alumni-list"></div>
    <button id="load-more" class="btn btn-primary mt-4">Load More</button>
</div>
@endsection

@push('styles')
<style>
.alumni-card {
    border-radius: 1.2rem;
    transition: box-shadow 0.2s, transform 0.2s;
}
.alumni-card:hover {
    box-shadow: 0 8px 32px rgba(13,110,253,0.13);
    transform: translateY(-4px) scale(1.03);
}
.card-title {
    font-weight: 600;
}
.alumni-card .d-flex.justify-content-center.align-items-center {
    min-height: 120px;
}
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let page = 1;
function loadAngkatan() {
    $('#load-more').prop('disabled', true).text('Loading...');
    $.get("{{ route('alumni.ajax-angkatan') }}", {page}, function(res) {
        if(res.alumni) $('#alumni-list').append(res.alumni);
        if(res.hasMore) {
            $('#load-more').prop('disabled', false).text('Lihat Angkatan Lainnya');
            page++;
        } else {
            $('#load-more').hide();
        }
    });
}
$('#load-more').on('click', loadAngkatan);
$(document).ready(loadAngkatan);
</script>
@endpush 