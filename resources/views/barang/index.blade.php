@extends('layouts.admin')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-1">Stok Barang</h5>
        <small class="text-muted">Manajemen daftar produk & harga jual</small>
    </div>

    <a href="{{ route('barang.create') }}" 
       class="btn btn-primary btn-sm px-4 shadow-sm">
        + Tambah Barang
    </a>
</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- CARD TABLE --}}
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th>Produk</th>
                    <th class="text-end">Harga Luar</th>
                    <th class="text-center" style="width:80px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($barangs as $b)
                    <tr class="hover-row">
                        
                        {{-- PRODUK --}}
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img
                                    src="{{ $b->foto ? asset('storage/'.$b->foto) : 'https://placehold.co/60x60?text=NA' }}"
                                    class="rounded border"
                                    width="50"
                                    height="50"
                                    style="object-fit:cover"
                                >

                                <div>
                                    <div class="fw-semibold text-dark small text-truncate" style="max-width:240px;">
                                        {{ $b->nama }}
                                    </div>
                                    <small class="text-muted d-block">
                                        Modal: Rp {{ number_format($b->harga_modal) }}
                                    </small>
                                </div>
                            </div>
                        </td>

                        {{-- HARGA --}}
                        <td class="text-end">
                            <span class="fw-bold text-primary fs-6">
                                Rp {{ number_format($b->harga_luar) }}
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center">
                            <div class="dropdown">
                                <button
                                    class="btn btn-light btn-sm rounded-circle shadow-sm"
                                    type="button"
                                    data-bs-toggle="dropdown">
                                    ⋮
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li>
                                        <a class="dropdown-item small" 
                                           href="{{ route('barang.show', $b->id) }}">
                                            🔍 Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item small" 
                                           href="{{ route('barang.edit', $b->id) }}">
                                            ✏️ Edit
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('barang.destroy', $b->id) }}" 
                                              method="POST"
                                              onsubmit="return confirm('Yakin hapus barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger small">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-5">
                            <div class="text-muted">
                                <div class="mb-2 fs-5">Belum ada barang</div>
                                <small>Klik tombol tambah untuk mulai input data.</small>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- STYLE HALUS --}}
<style>
.hover-row:hover {
    background-color: #f8f9fa;
    transition: 0.2s ease-in-out;
}
</style>

@endsection