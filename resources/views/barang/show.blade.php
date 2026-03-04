@extends('layouts.admin')

@section('content')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            
            <h5 class="fw-bold mb-1">Detail Barang</h5>
            <small class="text-muted">Informasi lengkap produk</small>
        </div>

        <div class="d-flex gap-2">
            


        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="row g-0">

            {{-- IMAGE --}}
            <div class="col-md-5 bg-light d-flex align-items-center justify-content-center">
                <img src="{{ $barang->foto ? asset('storage/' . $barang->foto) : 'https://placehold.co/500x400?text=No+Image' }}"
                    class="img-fluid p-3" style="max-height:400px; object-fit:contain;">
            </div>

            {{-- DETAIL --}}
            <div class="col-md-7">
                <div class="card-body">

                    <h4 class="fw-bold mb-3">{{ $barang->nama }}</h4>

                    <div class="bg-light rounded p-4">
                        <div class="d-flex justify-content-between border-top pt-3 mt-3">
                            <span class="fw-semibold">Harga Modal</span>
                            <span class="fw-bold text-primary fs-5">
                                Rp {{ number_format($barang->harga_modal) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-3 mt-3">
                            <span class="fw-semibold">Harga Toko</span>
                            <span class="fw-bold text-primary fs-5">
                                Rp {{ number_format($barang->harga_dalam) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between border-top pt-3 mt-3">
                            <span class="fw-semibold">Harga Luaran</span>
                            <span class="fw-bold text-primary fs-5">
                                Rp {{ number_format($barang->harga_luar) }}
                            </span>
                        </div>

                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning flex-fill shadow-sm">
                            ✏️ Edit Data
                        </a>
                        <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary btn-sm px-3">
                            Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
