@extends('layouts.admin')

@section('content')
<div class="card p-4 shadow-sm">
    <h5 class="fw-bold mb-4">Edit Barang</h5>
    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label small fw-bold">Nama Barang</label>
            <input type="text" name="nama" class="form-control" value="{{ $barang->nama }}" required>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label small">Modal</label>
                <input type="number" name="harga_modal" class="form-control" value="{{ $barang->harga_modal }}">
            </div>
            <div class="col">
                <label class="form-label small text-primary">Luar</label>
                <input type="number" name="harga_luar" class="form-control font-weight-bold" value="{{ $barang->harga_luar }}">
            </div>
        </div>
        <div class="mb-3 text-center">
            <img src="{{ $barang->foto ? asset('storage/'.$barang->foto) : 'https://placehold.co/100' }}" class="rounded mb-2" width="100">
            <input type="file" name="foto" class="form-control form-control-sm">
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Data</button>
    </form>
</div>
@endsection