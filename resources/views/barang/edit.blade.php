@extends('layouts.admin')

@section('content')
<div x-data>
    <div class="mb-3">
        <a href="{{ route('barang.index') }}" class="text-decoration-none small text-muted">← Kembali</a>
        <h5 class="fw-bold">Edit Barang</h5>
    </div>

    {{-- GLOBAL ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card p-3 mb-3 border-0 shadow-sm border-start border-warning border-4">

            <div class="d-flex justify-content-between mb-2">
                <span class="badge bg-warning text-dark">Edit Data</span>
            </div>

            {{-- Nama --}}
            <input type="text"
                   name="nama"
                   class="form-control mb-2 @error('nama') is-invalid @enderror"
                   value="{{ old('nama', $barang->nama) }}"
                   placeholder="Nama Produk"
                   required>
            @error('nama')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror

            {{-- Harga --}}
            <div class="row g-2 mb-2">
                <div class="col-4">
                    <label class="small text-muted">Modal</label>
                    <input type="number"
                           name="harga_modal"
                           class="form-control form-control-sm @error('harga_modal') is-invalid @enderror"
                           value="{{ old('harga_modal', $barang->harga_modal) }}"
                           required>
                    @error('harga_modal')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-4">
                    <label class="small text-muted">Hrg Dalam</label>
                    <input type="number"
                           name="harga_dalam"
                           class="form-control form-control-sm @error('harga_dalam') is-invalid @enderror"
                           value="{{ old('harga_dalam', $barang->harga_dalam) }}"
                           required>
                    @error('harga_dalam')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-4">
                    <label class="small text-muted">Hrg Luar</label>
                    <input type="number"
                           name="harga_luar"
                           class="form-control form-control-sm @error('harga_luar') is-invalid @enderror"
                           value="{{ old('harga_luar', $barang->harga_luar) }}"
                           required>
                    @error('harga_luar')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Foto --}}
            <div class="text-center mb-2">
                <img src="{{ $barang->foto ? asset('storage/'.$barang->foto) : 'https://placehold.co/100' }}"
                     class="rounded mb-2 shadow-sm"
                     width="100">

                <input type="file"
                       name="foto"
                       class="form-control form-control-sm @error('foto') is-invalid @enderror">

                @error('foto')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
                <div class="d-flex gap-2">

        <button type="submit" class="btn btn-warning w-100 fw-bold shadow">
            UPDATE DATA
        </button>
         <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary flex-fill">
                        Kembali
                    </a>
                </div>
    </form>
</div>
@endsection