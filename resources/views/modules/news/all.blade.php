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
    <button id="load-more" class="btn btn-primary mt-4">Load More</button>
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
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let page = 1;
function loadNews() {
    $('#load-more').prop('disabled', true).text('Loading...');
    $.get("{{ route('news.ajax-all') }}", {page, q: '{{ request('q') }}'}, function(res) {
        if(res.news) $('#news-list').append(res.news);
        if(res.hasMore) {
            $('#load-more').prop('disabled', false).text('Load More');
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