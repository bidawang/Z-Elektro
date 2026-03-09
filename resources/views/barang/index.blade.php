@extends('layouts.admin')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5 class="fw-bold mb-0">📦 Stok Barang</h5>
        <small class="text-muted">Kelola daftar barang dan harga jual</small>
    </div>
    <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
        + Tambah Barang
    </a>
</div>

{{-- TABLE --}}
<div class="card shadow-sm border-0 overflow-visible">
    <div class="table-responsive overflow-visible">

        <table class="table align-middle mb-0">
            <thead class="table-light text-uppercase small">
                <tr>
                    <th>Barang</th>
                    <th class="text-end">Harga Luar</th>
                    <th class="text-center" style="width:70px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($barangs as $b)
                    <tr>
                        {{-- BARANG --}}
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img
                                    src="{{ $b->foto ? asset('storage/'.$b->foto) : 'https://placehold.co/60x60?text=NA' }}"
                                    class="rounded"
                                    width="45"
                                    height="45"
                                    style="object-fit:cover"
                                >
                                <div>
                                    <div class="fw-semibold small text-truncate" style="max-width:220px;">
                                        {{ $b->nama }}
                                    </div>
                                    <small class="text-muted">
                                        Modal: Rp {{ number_format($b->harga_modal) }}
                                    </small>
                                </div>
                            </div>
                        </td>

                        {{-- HARGA --}}
                        <td class="text-end fw-bold text-primary">
                            Rp {{ number_format($b->harga_luar) }}
                        </td>

                        {{-- AKSI --}}
                        <td class="text-center">
                            <div class="dropdown position-static">
                                <button
                                    class="btn btn-light btn-sm rounded-circle"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    ⋮
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('barang.show', $b->id) }}">
                                            🔍 Detail
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('barang.edit', $b->id) }}">
                                            ✏️ Edit
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('barang.destroy', $b->id) }}" method="POST"
                                              onsubmit="return confirm('Yakin hapus barang ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item text-danger">
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
                        <td colspan="3" class="text-center py-4 text-muted">
                            Belum ada data barang
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
