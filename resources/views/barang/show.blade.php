@extends('layouts.admin')

@section('content')
<div class="card overflow-hidden">
    <img src="{{ $barang->foto ? asset('storage/'.$barang->foto) : 'https://placehold.co/400x300' }}" class="card-img-top">
    <div class="card-body">
        <h4 class="fw-bold">{{ $barang->nama }}</h4>
        <div class="bg-light p-3 rounded mb-3">
            <div class="d-flex justify-content-between"><span>Harga Modal</span> <span class="text-muted">Rp{{ number_format($barang->harga_modal) }}</span></div>
            <div class="d-flex justify-content-between"><span>Harga Dalam</span> <span class="fw-bold">Rp{{ number_format($barang->harga_dalam) }}</span></div>
            <div class="d-flex justify-content-between border-top mt-2 pt-2"><span>Harga Luar</span> <span class="fw-bold text-primary fs-5">Rp{{ number_format($barang->harga_luar) }}</span></div>
        </div>
        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning w-100 mb-2">Edit Data</a>
        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary w-100">Kembali</a>
    </div>
</div>
@endsection