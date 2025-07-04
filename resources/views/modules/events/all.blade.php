@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Semua Event</h3>
    </div>
    <form method="GET" action="{{ route('events.all') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Cari event..." value="{{ request('q') }}">
            <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
        </div>
    </form>
    <div class="row g-4" id="events-list"></div>
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
.event-card {
    transition: transform 0.2s, box-shadow 0.2s;
}
.event-card:hover {
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
function loadEvents() {
    $('#load-more').prop('disabled', true).text('Loading...');
    $.get("{{ route('events.ajax-all') }}", {page, q: '{{ request('q') }}'}, function(res) {
        if(res.events) $('#events-list').append(res.events);
        if(res.hasMore) {
            $('#load-more').prop('disabled', false).text('Load More');
            page++;
        } else {
            $('#load-more').hide();
        }
    });
}
$('#load-more').on('click', loadEvents);
$(document).ready(loadEvents);
</script>
@endpush 