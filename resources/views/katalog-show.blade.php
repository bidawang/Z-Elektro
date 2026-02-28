@extends('layouts.admin')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card p-4">

                {{-- FOTO --}}
                <div class="ratio ratio-1x1 mb-3 bg-light rounded overflow-hidden">
                    @if ($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}" class="w-100 h-100" style="object-fit:cover">
                    @else
                        <div class="d-flex align-items-center justify-content-center w-100 h-100">
                            <div class="fw-bold text-secondary" style="font-size:3rem;">
                                {{ strtoupper(substr($barang->nama, 0, 2)) }}
                            </div>
                        </div>
                    @endif
                </div>

                {{-- NAMA --}}
                <h5 class="fw-bold mb-1">{{ $barang->nama }}</h5>

                {{-- HARGA --}}
                <div class="fs-4 fw-bold text-primary mb-3">
                    Rp {{ number_format($barang->harga_luar) }}
                </div>

                <h6 class="fw-bold mb-3">Simulasi Cicilan</h6>

                <div class="list-group mb-4">

                    @foreach ($cicilanList as $item)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                {{ $item['tenor'] }} Bulan
                                <br>
                                <small class="text-muted">
                                    Total: Rp {{ number_format($item['total']) }}
                                </small>
                            </div>

                            <div class="fw-bold text-primary">
                                Rp {{ number_format($item['per_bulan']) }} / bulan
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="d-grid">
                    <a href="{{ route('katalog.index') }}" class="btn btn-outline-secondary rounded-pill">
                        Kembali ke Katalog
                    </a>
                </div>

            </div>

        </div>
    </div>
@endsection
