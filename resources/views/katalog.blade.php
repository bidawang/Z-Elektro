@extends('layouts.admin')
@section('header-filter')
<div class="filter-bar">
    <form id="filterForm">
        <div class="row g-2 align-items-center">

            <div class="col-12 col-md-6">
                <input type="text"
                       name="search"
                       class="form-control form-control-sm"
                       placeholder="Cari produk…">
            </div>

            <div class="col-8 col-md-4">
                <input type="range"
                       name="max_price"
                       id="max_price"
                       min="0" max="10000000" step="50000"
                       value="5000000"
                       class="form-range">
                <small class="text-muted">
                    Maks: <span id="priceText">Rp 5.000.000</span>
                </small>
            </div>

            <div class="col-4 col-md-2">
                <button class="btn btn-primary btn-sm w-100">
                    Cari
                </button>
            </div>

        </div>
    </form>
</div>
@endsection
@section('content')
    
    {{-- KATALOG --}}
    <div id="katalog-wrapper">
        @include('partials.katalog-cards', ['barangs' => $barangs])
    </div>

    <div id="loading" class="text-center py-3 d-none">
        <small class="text-muted">Memuat barang…</small>
    </div>

    <div id="end-data" class="text-center py-3 d-none">
        <small class="text-muted">Semua barang sudah ditampilkan</small>
    </div>
@endsection

@push('scripts')
<script>
let loading = false;
let finished = false;

$('#max_price').on('input', function () {
    $('#priceText').text(
        'Rp ' + parseInt(this.value).toLocaleString('id-ID')
    );
});

// LOAD DATA
function loadData(page = 1, reset = false) {
    if (loading || finished) return;

    loading = true;
    $('#loading').removeClass('d-none');

    $.ajax({
        url: "{{ route('katalog.index') }}",
        data: {
            page: page,
            search: $('input[name=search]').val(),
            max_price: $('#max_price').val()
        },
        success: function (res) {
            if (reset) {
                $('#katalog-wrapper').html(res);
                finished = false;
                $('#end-data').addClass('d-none');
            } else {
                $('#katalog-wrapper').append(res);
            }

            loading = false;
            $('#loading').addClass('d-none');

            if ($('.next-page').length === 0) {
                finished = true;
                $('#end-data').removeClass('d-none');
            }
        }
    });
}

// SUBMIT FILTER
$('#filterForm').on('submit', function (e) {
    e.preventDefault();
    loadData(1, true);
});

// INFINITE SCROLL
$(window).on('scroll', function () {
    if (loading || finished) return;

    if ($(window).scrollTop() + $(window).height()
        >= $(document).height() - 150) {

        let nextPage = $('.next-page').last().data('next');
        if (nextPage) {
            loadData(nextPage);
        }
    }
});
</script>
@endpush
