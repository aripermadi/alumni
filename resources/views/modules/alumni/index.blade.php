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
    <div class="text-center my-4">
        <button id="load-more" class="btn btn-loadmore" type="button">
            <span class="spinner-border spinner-border-sm me-2 d-none" id="loadmore-spinner"></span>
            <span class="loadmore-text"><i class="fas fa-angle-down me-1"></i>Lihat Angkatan Lainnya</span>
        </button>
    </div>
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
.btn-loadmore {
    background: #0d6efd;
    color: #fff;
    border: none;
    border-radius: 999px;
    padding: 0.75rem 2.5rem;
    font-size: 1.1rem;
    font-weight: 500;
    transition: background 0.2s, box-shadow 0.2s;
    box-shadow: none;
    outline: none;
}
.btn-loadmore:hover, .btn-loadmore:focus {
    background: #0b5ed7;
    color: #fff;
}
.btn-loadmore:disabled {
    opacity: 0.7;
}
.btn-loadmore .fa-angle-down {
    font-size: 1.1em;
    vertical-align: middle;
}
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let page = 1;
function setLoading(isLoading) {
    if(isLoading) {
        $('#load-more').prop('disabled', true);
        $('#loadmore-spinner').removeClass('d-none');
        $('.loadmore-text').text('Loading...');
    } else {
        $('#load-more').prop('disabled', false);
        $('#loadmore-spinner').addClass('d-none');
        $('.loadmore-text').html('<i class="fas fa-angle-down me-1"></i>Lihat Angkatan Lainnya');
    }
}
function loadAngkatan() {
    setLoading(true);
    $.get("{{ route('alumni.ajax-angkatan') }}", {page}, function(res) {
        if(res.alumni) $('#alumni-list').append(res.alumni);
        if(res.hasMore) {
            setLoading(false);
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