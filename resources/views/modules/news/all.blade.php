@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Semua Berita</h3>
    </div>
    <form method="GET" action="{{ route('news.all') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari berita..." value="{{ request('q') }}">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
        </div>
    </form>
    <div class="row g-4" id="news-list"></div>
    <div class="text-center my-4">
        <button id="load-more" class="btn btn-loadmore" type="button">
            <span class="spinner-border spinner-border-sm me-2 d-none" id="loadmore-spinner"></span>
            <span class="loadmore-text"><i class="fas fa-angle-down me-1"></i>Load More</span>
        </button>
    </div>
</div>
@endsection

@push('styles')
<style>
.card-title {
    font-weight: 600;
}
.card-img-top {
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
}
.card {
    border-radius: 1rem;
    transition: box-shadow 0.2s;
}
.card:hover {
    box-shadow: 0 6px 24px rgba(13,110,253,0.12);
}
.btn-info {
    min-width: 80px;
}
.news-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.news-card:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: 0 8px 32px rgba(13,110,253,0.13);
}
.input-group input[type="text"] {
    border-radius: 1rem 0 0 1rem;
}
.input-group .btn {
    border-radius: 0 1rem 1rem 0;
}
#load-more[disabled] {
    opacity: 0.7;
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
        $('.loadmore-text').html('<i class="fas fa-angle-down me-1"></i>Load More');
    }
}
function loadNews() {
    setLoading(true);
    $.get("{{ route('news.ajax-all') }}", {page, q: '{{ request('q') }}'}, function(res) {
        if(res.news) $('#news-list').append(res.news);
        if(res.hasMore) {
            setLoading(false);
            page++;
        } else {
            $('#load-more').hide();
        }
    });
}
$('#load-more').on('click', loadNews);
$(document).ready(loadNews);
</script>
@endpush 